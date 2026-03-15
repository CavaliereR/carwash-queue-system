<?php
// ── api.php ─────────────────────────────────────────────────
// Single API endpoint — all admin + client AJAX calls go here
// ────────────────────────────────────────────────────────────
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
require_once __DIR__ . '/db.php';

$action = $_REQUEST['action'] ?? '';

try {
    switch ($action) {

        // ════════════════════ SLOTS ══════════════════════════
        case 'get_slots':
            $db  = getDB();
            $res = $db->query("SELECT slot_id AS slotId, location, is_available AS isAvailable FROM slots ORDER BY slot_id");
            echo json_encode($res->fetch_all(MYSQLI_ASSOC));
            break;

        case 'toggle_slot':
            $db     = getDB();
            $data   = json_decode(file_get_contents('php://input'), true) ?? $_POST;
            $slotId = $db->real_escape_string($data['slotId'] ?? '');
            $avail  = intval($data['isAvailable'] ?? 0);
            $result = $db->query("UPDATE slots SET is_available=$avail WHERE slot_id='$slotId'");
            echo json_encode([
                'ok'          => (bool)$result,
                'slotId'      => $slotId,
                'isAvailable' => $avail,
                'error'       => $db->error ?: null
            ]);
            break;

        case 'add_slot':
            $db       = getDB();
            $data     = json_decode(file_get_contents('php://input'), true) ?? $_POST;
            $slotId   = strtoupper(trim($data['slotId'] ?? ''));
            $location = trim($data['location'] ?? '');
            $avail    = intval($data['isAvailable'] ?? 1);

            if ($slotId === '' || $location === '') {
                http_response_code(400);
                echo json_encode(['ok' => false, 'error' => 'slotId and location are required']);
                break;
            }

            $chk = $db->prepare("SELECT slot_id FROM slots WHERE slot_id = ?");
            $chk->bind_param('s', $slotId);
            $chk->execute();
            if ($chk->get_result()->num_rows > 0) {
                http_response_code(409);
                echo json_encode(['ok' => false, 'error' => 'Slot ID already exists']);
                break;
            }

            $stmt = $db->prepare("INSERT INTO slots (slot_id, location, is_available) VALUES (?, ?, ?)");
            $stmt->bind_param('ssi', $slotId, $location, $avail);
            $stmt->execute();
            echo json_encode(['ok' => true, 'slotId' => $slotId]);
            break;

        case 'delete_slot':
            $db     = getDB();
            $data   = json_decode(file_get_contents('php://input'), true) ?? $_POST;
            $slotId = trim($data['slotId'] ?? '');

            if ($slotId === '') {
                http_response_code(400);
                echo json_encode(['ok' => false, 'error' => 'slotId is required']);
                break;
            }

            $stmt = $db->prepare("DELETE FROM slots WHERE slot_id = ?");
            $stmt->bind_param('s', $slotId);
            $stmt->execute();
            echo json_encode(['ok' => true]);
            break;

        // ════════════════════ SERVICES ═══════════════════════
        case 'get_services':
            $db  = getDB();
            $res = $db->query("SELECT id, name, car_price AS carPrice, moto_price AS motoPrice, is_available AS isAvailable FROM services ORDER BY id");
            echo json_encode($res->fetch_all(MYSQLI_ASSOC));
            break;

        case 'update_price':
            $db        = getDB();
            $data      = json_decode(file_get_contents('php://input'), true) ?? $_POST;
            $id        = intval($data['id'] ?? 0);
            $carPrice  = floatval($data['carPrice']  ?? 0);
            $motoPrice = floatval($data['motoPrice'] ?? 0);
            $result    = $db->query("UPDATE services SET car_price=$carPrice, moto_price=$motoPrice WHERE id=$id");
            echo json_encode(['ok' => (bool)$result, 'error' => $db->error ?: null]);
            break;

        case 'toggle_service':
            $db    = getDB();
            $data  = json_decode(file_get_contents('php://input'), true) ?? $_POST;
            $id    = intval($data['id'] ?? 0);
            $avail = intval($data['isAvailable'] ?? 0);
            $result = $db->query("UPDATE services SET is_available=$avail WHERE id=$id");
            echo json_encode(['ok' => (bool)$result, 'id' => $id, 'isAvailable' => $avail, 'error' => $db->error ?: null]);
            break;

        case 'add_service':
            $db        = getDB();
            $data      = json_decode(file_get_contents('php://input'), true) ?? $_POST;
            $name      = trim($data['name'] ?? '');
            $carPrice  = floatval($data['carPrice']  ?? 0);
            $motoPrice = floatval($data['motoPrice'] ?? 0);
            $avail     = intval($data['isAvailable'] ?? 1);

            if ($name === '') {
                http_response_code(400);
                echo json_encode(['ok' => false, 'error' => 'Service name is required']);
                break;
            }

            // Check for duplicate name
            $chk = $db->prepare("SELECT id FROM services WHERE LOWER(name) = LOWER(?)");
            $chk->bind_param('s', $name);
            $chk->execute();
            if ($chk->get_result()->num_rows > 0) {
                http_response_code(400);
                echo json_encode(['ok' => false, 'error' => 'A service with this name already exists']);
                break;
            }

            $stmt = $db->prepare("
                INSERT INTO services (name, car_price, moto_price, is_available)
                VALUES (?, ?, ?, ?)
            ");
            $stmt->bind_param('sddi', $name, $carPrice, $motoPrice, $avail);
            $stmt->execute();

            $newId = $db->insert_id;
            $row   = $db->query("
                SELECT id, name, car_price AS carPrice, moto_price AS motoPrice, is_available AS isAvailable
                FROM services WHERE id = $newId
            ")->fetch_assoc();
            echo json_encode(['ok' => true, 'service' => $row]);
            break;

        case 'delete_service':
            $db   = getDB();
            $data = json_decode(file_get_contents('php://input'), true) ?? $_POST;
            $id   = intval($data['id'] ?? 0);

            if ($id === 0) {
                http_response_code(400);
                echo json_encode(['ok' => false, 'error' => 'Invalid service ID']);
                break;
            }

            $stmt = $db->prepare("DELETE FROM services WHERE id = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            echo json_encode(['ok' => true]);
            break;

        // ════════════════════ ORDERS ═════════════════════════
        case 'get_orders':
            $db  = getDB();
            $res = $db->query("
                SELECT
                    id,
                    ref_id        AS refId,
                    customer_name AS customerName,
                    plate_number  AS plateNumber,
                    vehicle_type  AS vehicleType,
                    slot_id       AS slotId,
                    service,
                    total,
                    status,
                    source,
                    DATE_FORMAT(created_at,  '%Y-%m-%d %H:%i') AS timestamp,
                    start_time,
                    end_time,
                    duration
                FROM orders
                ORDER BY created_at DESC
            ");
            echo json_encode($res->fetch_all(MYSQLI_ASSOC));
            break;

        case 'add_order':
            $db     = getDB();
            $data   = json_decode(file_get_contents('php://input'), true) ?? $_POST;
            $refId  = 'TXN-' . strtoupper(substr(uniqid(), -6));
            $name   = trim($data['customerName'] ?? '');
            $plate  = trim($data['plateNumber']  ?? '');
            $vtype  = $data['vehicleType'] ?? '';
            $slotId = $data['slotId']      ?? '';
            $svc    = $data['service']     ?? '';
            $total  = floatval($data['total']  ?? 0);
            $status = $data['status'] ?? 'Pending';
            $source = $data['source'] ?? 'admin';

            $startTime = ($status === 'In Progress') ? date('Y-m-d H:i:s') : null;

            $stmt = $db->prepare("
                INSERT INTO orders
                    (ref_id, customer_name, plate_number, vehicle_type, slot_id, service, total, status, source, start_time)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->bind_param('ssssssdsss', $refId, $name, $plate, $vtype, $slotId, $svc, $total, $status, $source, $startTime);
            $stmt->execute();

            $newId = $db->insert_id;
            $row   = $db->query("
                SELECT id, ref_id AS refId, customer_name AS customerName, plate_number AS plateNumber,
                       vehicle_type AS vehicleType, slot_id AS slotId, service, total, status, source,
                       DATE_FORMAT(created_at,'%Y-%m-%d %H:%i') AS timestamp, start_time, end_time, duration
                FROM orders WHERE id=$newId
            ")->fetch_assoc();
            echo json_encode(['ok' => true, 'order' => $row]);
            break;

        case 'update_order':
            $db     = getDB();
            $data   = json_decode(file_get_contents('php://input'), true) ?? $_POST;
            $id     = intval($data['id'] ?? 0);
            $name   = trim($data['customerName'] ?? '');
            $plate  = trim($data['plateNumber']  ?? '');
            $vtype  = $data['vehicleType'] ?? '';
            $slotId = $data['slotId']      ?? '';
            $svc    = $data['service']     ?? '';
            $total  = floatval($data['total']  ?? 0);
            $status = $data['status'] ?? 'Pending';

            $cur = $db->query("SELECT status, start_time FROM orders WHERE id=$id")->fetch_assoc();
            $prevStatus = $cur['status'] ?? '';

            $startTime = $cur['start_time'];
            $endTime   = null;
            $duration  = null;

            if ($status === 'In Progress' && $prevStatus !== 'In Progress') {
                $startTime = date('Y-m-d H:i:s');
            }

            if ($status === 'Completed' && $prevStatus !== 'Completed') {
                $endTime = date('Y-m-d H:i:s');
                if ($startTime) {
                    $secs     = strtotime($endTime) - strtotime($startTime);
                    $mins     = max(0, intdiv($secs, 60));
                    $duration = $mins >= 60
                        ? intdiv($mins, 60).'h '.($mins % 60).'m'
                        : $mins.'m';
                }
            }

            $stSql = $startTime ? "'$startTime'" : 'NULL';
            $etSql = $endTime   ? "'$endTime'"   : 'NULL';
            $dSql  = $duration  ? "'".$db->real_escape_string($duration)."'" : 'NULL';

            $stmt = $db->prepare("
                UPDATE orders
                SET customer_name=?, plate_number=?, vehicle_type=?, slot_id=?,
                    service=?, total=?, status=?,
                    start_time=$stSql, end_time=$etSql, duration=$dSql
                WHERE id=?
            ");
            $stmt->bind_param('sssssdsi', $name, $plate, $vtype, $slotId, $svc, $total, $status, $id);
            $stmt->execute();
            echo json_encode(['ok' => true, 'error' => $db->error ?: null]);
            break;

        case 'update_order_status':
            $db     = getDB();
            $data   = json_decode(file_get_contents('php://input'), true) ?? $_POST;
            $id     = intval($data['id'] ?? 0);
            $status = $data['status'] ?? '';

            $allowed = ['Pending','In Progress','Completed','Cancelled'];
            if (!in_array($status, $allowed)) {
                http_response_code(400);
                echo json_encode(['ok' => false, 'error' => 'Invalid status']);
                break;
            }

            $cur     = $db->query("SELECT status, start_time FROM orders WHERE id=$id")->fetch_assoc();
            $prevSt  = $cur['status']     ?? '';
            $startTs = $cur['start_time'] ?? null;

            $setSql = "status='".$db->real_escape_string($status)."'";

            if ($status === 'In Progress' && $prevSt !== 'In Progress') {
                $now    = date('Y-m-d H:i:s');
                $setSql .= ", start_time='$now'";
            }

            if (($status === 'Completed' || $status === 'Cancelled') && $prevSt !== 'Completed' && $prevSt !== 'Cancelled') {
                $now    = date('Y-m-d H:i:s');
                $setSql .= ", end_time='$now'";
                if ($startTs) {
                    $secs = strtotime($now) - strtotime($startTs);
                    $mins = max(0, intdiv($secs, 60));
                    $dur  = $mins >= 60
                        ? intdiv($mins, 60).'h '.($mins % 60).'m'
                        : $mins.'m';
                    $setSql .= ", duration='".$db->real_escape_string($dur)."'";
                }
            }

            $result = $db->query("UPDATE orders SET $setSql WHERE id=$id");
            echo json_encode(['ok' => (bool)$result, 'error' => $db->error ?: null]);
            break;

        case 'delete_order':
            $db   = getDB();
            $data = json_decode(file_get_contents('php://input'), true) ?? $_POST;
            $id   = intval($data['id'] ?? 0);
            $stmt = $db->prepare("DELETE FROM orders WHERE id=?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            echo json_encode(['ok' => true]);
            break;

        // ════════════════════ KIOSK ══════════════════════════
        case 'submit_kiosk_order':
            $db   = getDB();
            $data = json_decode(file_get_contents('php://input'), true) ?? $_POST;
            $refId  = $data['refId']        ?? ('KSK-'.strtoupper(substr(uniqid(),-6)));
            $name   = trim($data['customerName'] ?? '');
            $plate  = trim($data['plateNumber']  ?? '');
            $vtype  = $data['vehicleType'] ?? '';
            $slotId = $data['slotId']      ?? '';
            $svc    = $data['service']     ?? '';
            $total  = floatval($data['total'] ?? 0);

            $chk = $db->prepare("SELECT id FROM orders WHERE ref_id=?");
            $chk->bind_param('s', $refId);
            $chk->execute();
            if ($chk->get_result()->num_rows > 0) {
                echo json_encode(['ok' => false, 'error' => 'Duplicate ref']);
                break;
            }

            $stmt = $db->prepare("
                INSERT INTO orders
                    (ref_id, customer_name, plate_number, vehicle_type, slot_id, service, total, status, source)
                VALUES (?, ?, ?, ?, ?, ?, ?, 'Pending', 'kiosk')
            ");
            $stmt->bind_param('ssssssd', $refId, $name, $plate, $vtype, $slotId, $svc, $total);
            $stmt->execute();
            echo json_encode(['ok' => true, 'refId' => $refId]);
            break;

        default:
            http_response_code(400);
            echo json_encode(['error' => "Unknown action: $action"]);
    }
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}