<?php
// ── api.php ─────────────────────────────────────────────────
// Single API endpoint — all admin + client AJAX calls go here
// Usage:  api.php?action=ACTION_NAME   (GET or POST)
// ────────────────────────────────────────────────────────────
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
require_once __DIR__ . '/db.php';

$action = $_REQUEST['action'] ?? '';

try {
    switch ($action) {

        // ════════════════════ SLOTS ══════════════════════════
        case 'get_slots':
            $db = getDB();
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
                'ok'           => (bool)$result,
                'slotId'       => $slotId,
                'isAvailable'  => $avail,
                'affectedRows' => $db->affected_rows,
                'error'        => $db->error ?: null
            ]);
            break;

        // ════════════════════ SERVICES ═══════════════════════
        case 'get_services':
            $db = getDB();
            $res = $db->query("SELECT id, name, car_price AS carPrice, moto_price AS motoPrice, is_available AS isAvailable FROM services ORDER BY id");
            echo json_encode($res->fetch_all(MYSQLI_ASSOC));
            break;

        case 'update_price':
            $db       = getDB();
            $data     = json_decode(file_get_contents('php://input'), true) ?? $_POST;
            $id       = intval($data['id'] ?? 0);
            $carPrice = floatval($data['carPrice'] ?? 0);
            $motoPrice= floatval($data['motoPrice'] ?? 0);
            $result   = $db->query("UPDATE services SET car_price=$carPrice, moto_price=$motoPrice WHERE id=$id");
            echo json_encode([
                'ok'           => (bool)$result,
                'affectedRows' => $db->affected_rows,
                'error'        => $db->error ?: null
            ]);
            break;

        case 'toggle_service':
            $db    = getDB();
            $data  = json_decode(file_get_contents('php://input'), true) ?? $_POST;
            $id    = intval($data['id'] ?? 0);
            $avail = intval($data['isAvailable'] ?? 0);
            $result = $db->query("UPDATE services SET is_available=$avail WHERE id=$id");
            echo json_encode([
                'ok'           => (bool)$result,
                'id'           => $id,
                'isAvailable'  => $avail,
                'affectedRows' => $db->affected_rows,
                'error'        => $db->error ?: null
            ]);
            break;

        // ════════════════════ ORDERS ═════════════════════════
        case 'get_orders':
            $db = getDB();
            $res = $db->query("
                SELECT id, ref_id AS refId, customer_name AS customerName,
                       plate_number AS plateNumber, vehicle_type AS vehicleType,
                       slot_id AS slotId, service, total, status, source,
                       DATE_FORMAT(created_at,'%Y-%m-%d %H:%i') AS timestamp
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
            $plate  = trim($data['plateNumber'] ?? '');
            $vtype  = $data['vehicleType'] ?? '';
            $slotId = $data['slotId'] ?? '';
            $svc    = $data['service'] ?? '';
            $total  = floatval($data['total'] ?? 0);
            $status = $data['status'] ?? 'Pending';
            $source = $data['source'] ?? 'admin';

            $stmt = $db->prepare("INSERT INTO orders (ref_id,customer_name,plate_number,vehicle_type,slot_id,service,total,status,source) VALUES (?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param('ssssssdss', $refId, $name, $plate, $vtype, $slotId, $svc, $total, $status, $source);
            $stmt->execute();

            $newId = $db->insert_id;
            $row   = $db->query("SELECT id, ref_id AS refId, customer_name AS customerName, plate_number AS plateNumber, vehicle_type AS vehicleType, slot_id AS slotId, service, total, status, source, DATE_FORMAT(created_at,'%Y-%m-%d %H:%i') AS timestamp FROM orders WHERE id=$newId")->fetch_assoc();
            echo json_encode(['ok' => true, 'order' => $row]);
            break;

        case 'update_order':
            $db   = getDB();
            $data = json_decode(file_get_contents('php://input'), true) ?? $_POST;
            $id     = intval($data['id'] ?? 0);
            $name   = trim($data['customerName'] ?? '');
            $plate  = trim($data['plateNumber'] ?? '');
            $vtype  = $data['vehicleType'] ?? '';
            $slotId = $data['slotId'] ?? '';
            $svc    = $data['service'] ?? '';
            $total  = floatval($data['total'] ?? 0);
            $status = $data['status'] ?? 'Pending';

            $stmt = $db->prepare("UPDATE orders SET customer_name=?,plate_number=?,vehicle_type=?,slot_id=?,service=?,total=?,status=? WHERE id=?");
            $stmt->bind_param('sssssdsi', $name, $plate, $vtype, $slotId, $svc, $total, $status, $id);
            $stmt->execute();
            echo json_encode(['ok' => true]);
            break;

        case 'delete_order':
            $db = getDB();
            $data = json_decode(file_get_contents('php://input'), true) ?? $_POST;
            $id   = intval($data['id'] ?? ($_POST['id'] ?? 0));
            $stmt = $db->prepare("DELETE FROM orders WHERE id=?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            echo json_encode(['ok' => true]);
            break;

        // ════════════════════ KIOSK (client) ═════════════════
        case 'submit_kiosk_order':
            $db   = getDB();
            $data = json_decode(file_get_contents('php://input'), true) ?? $_POST;
            $refId  = $data['refId'] ?? ('KSK-' . strtoupper(substr(uniqid(), -6)));
            $name   = trim($data['customerName'] ?? '');
            $plate  = trim($data['plateNumber'] ?? '');
            $vtype  = $data['vehicleType'] ?? '';
            $slotId = $data['slotId'] ?? '';
            $svc    = $data['service'] ?? '';
            $total  = floatval($data['total'] ?? 0);
            $source = 'kiosk';
            $status = 'Pending';

            // Avoid duplicate ref
            $check = $db->prepare("SELECT id FROM orders WHERE ref_id=?");
            $check->bind_param('s', $refId);
            $check->execute();
            if ($check->get_result()->num_rows > 0) {
                echo json_encode(['ok' => false, 'error' => 'Duplicate ref']);
                break;
            }

            $stmt = $db->prepare("INSERT INTO orders (ref_id,customer_name,plate_number,vehicle_type,slot_id,service,total,status,source) VALUES (?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param('ssssssdss', $refId, $name, $plate, $vtype, $slotId, $svc, $total, $status, $source);
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