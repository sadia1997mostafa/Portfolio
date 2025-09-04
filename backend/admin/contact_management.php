<?php
session_start();

// Only check session
if (!isset($_SESSION['admin'])) {
    header("Location: ../../login.php");
    exit();
}
?>


<?php


include '../db.php';

// Handle POST actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_id'])) {
        $id = intval($_POST['delete_id']);
        $stmt = $conn->prepare("DELETE FROM messages WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        header("Location: contact_management.php");
        exit;
    }
    if (isset($_POST['mark_read_id'])) {
        $id = intval($_POST['mark_read_id']);
        $stmt = $conn->prepare("UPDATE messages SET is_read = 1 WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        header("Location: contact_management.php?id={$id}");
        exit;
    }
    if (isset($_POST['mark_unread_id'])) {
        $id = intval($_POST['mark_unread_id']);
        $stmt = $conn->prepare("UPDATE messages SET is_read = 0 WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        header("Location: contact_management.php?id={$id}");
        exit;
    }
}

// If viewing specific message
$viewMessage = null;
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM messages WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    $viewMessage = $res->fetch_assoc();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Contact Management</title>
<link rel="stylesheet" href="style.css">
<style>
.inbox-container { display:flex; gap:20px; padding:20px; }
.inbox-list { width: 30%; border-right:1px solid #ddd; padding-right:10px; }
.inbox-list .item { padding:10px; border-bottom:1px solid #eee; text-decoration:none; display:block; color:#222; }
.unread { font-weight:700; background:#f9f9f9; }
.inbox-detail { flex:1; padding:10px; }
.actions form { display:inline-block; margin-right:8px; }
.small { font-size:0.9em; color:#666; }
.inbox-container {
  display: flex;
  gap: 20px;
  padding: 20px;
}

.inbox-container {
  display: flex;
  gap: 20px;
  padding: 20px;
}

/* Inbox panel */
.inbox-list {
  width: 28%;
  border-right: 2px solid #cbd5e1;  /* soft gray-blue border */
  background: #e0f2fe;              /* light blue shade */
  color: #0f172a;
  border-radius: 10px;
  overflow-y: auto;
  max-height: 85vh;
  box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}

/* Inbox title */
.inbox-list h3 {
  margin: 0;
  padding: 15px;
  font-size: 1.2em;
  text-align: center;
  color: #0369a1;   /* darker blue text */
  border-bottom: 1px solid #bae6fd;
  background: #bae6fd;  /* slightly darker header */
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
}

/* Each message item */
.inbox-list .item {
  display: block;
  padding: 12px 15px;
  border-bottom: 1px solid #bae6fd;
  text-decoration: none;
  color: #0f172a;
  transition: all 0.2s ease;
  border-left: 3px solid transparent;
  border-radius: 6px;
  margin: 4px 6px;
  background: #7aa8c6ff; /* light card look */
}

/* Hover effect */
.inbox-list .item:hover {
  background: #83aee7ff; /* medium-light blue hover */
  border-left: 3px solid #0284c7; /* blue accent */
  cursor: pointer;
}

/* Unread messages */
.unread {
  font-weight: bold;
  background: #75c7f3ff; /* more visible blue for unread */
  border-left: 3px solid #f43f5e; /* red accent */
}

/* Subject & timestamp */
.inbox-list .small {
  display: block;
  font-size: 0.85em;
  color: #334155;
  margin-top: 3px;
}

</style>
</head>
<body>
<h1>Contact Management</h1>
<div class="inbox-container">
  <div class="inbox-list">
    <h3>Inbox</h3>
    <?php
    $sql = "SELECT id, name, email, subject, is_read, created_at FROM messages ORDER BY created_at DESC";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $cls = $row['is_read'] ? '' : 'unread';
        echo "<a class='item {$cls}' href='contact_management.php?id={$row['id']}'>
                <strong>" . htmlspecialchars($row['name']) . "</strong><br>
                <span class='small'>" . htmlspecialchars($row['subject']) . " — " . htmlspecialchars($row['created_at']) . "</span>
              </a>";
    }
    ?>
  </div>

  <div class="inbox-detail">
    <?php if ($viewMessage): ?>
      <h2><?php echo htmlspecialchars($viewMessage['subject']); ?></h2>
      <p><strong>From:</strong> <?php echo htmlspecialchars($viewMessage['name']); ?> &lt;<?php echo htmlspecialchars($viewMessage['email']); ?>&gt;</p>
      <p class="small"><strong>Received:</strong> <?php echo htmlspecialchars($viewMessage['created_at']); ?></p>

      <div class="actions">
        <!-- Mark read/unread -->
        <?php if ($viewMessage['is_read']): ?>
          <form method="post" style="display:inline;">
            <input type="hidden" name="mark_unread_id" value="<?php echo $viewMessage['id']; ?>">
            <button type="submit">Mark Unread</button>
          </form>
        <?php else: ?>
          <form method="post" style="display:inline;">
            <input type="hidden" name="mark_read_id" value="<?php echo $viewMessage['id']; ?>">
            <button type="submit">Mark Read</button>
          </form>
        <?php endif; ?>

        <!-- Delete -->
        <form method="post" onsubmit="return confirm('Delete this message?');" style="display:inline;">
          <input type="hidden" name="delete_id" value="<?php echo $viewMessage['id']; ?>">
          <button type="submit">Delete</button>
        </form>

        <!-- Reply (opens email client) -->
        <a href="mailto:<?php echo htmlspecialchars($viewMessage['email']); ?>?subject=Re:%20<?php echo rawurlencode($viewMessage['subject']); ?>">Reply</a>
      </div>

      <hr>
      <div style="white-space:pre-wrap;"><?php echo nl2br(htmlspecialchars($viewMessage['message'])); ?></div>
    <?php else: ?>
      <p>Select a message from the left to view details.</p>
    <?php endif; ?>
  </div>
</div>
</body>
</html>
<?php $conn->close(); ?>


