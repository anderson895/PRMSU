<?php
if (isset($_GET['submitType'])) {
    include('../../db/db_class.php');
    $admin_db = new admin_class();
    $db = new global_class();
    $submitType = $_GET['submitType'];

    if ($submitType == 'getMessages') {
        $userId = $_GET['userId'];
        $messages = $admin_db->getMessages($userId);
        if ($messages->num_rows > 0) {
            while ($message = $messages->fetch_assoc()) {
                $messagePosition = ($message['SENDER_ID'] == $userId) ? 'message-left' : 'message-right';
                $dateTimeString = $message['DATE_TIME'];
                $dateTime = new DateTime($dateTimeString);
                $formattedDateTime = $dateTime->format('F j, Y g:i a'); // Format as "Month day, Year Hour:Minute AM/PM"


                echo '<div class="per-message-container ' . $messagePosition . '">
                        <p>' . $message['MESSAGE'] . '</p>
                        <span>' . $formattedDateTime . '</span>
                      </div>';
            }
        } else {
            echo '<h6 class="mt-5">No message found.</h6>';
        }
    } elseif ($submitType == 'FacultyGetMessages') {
        $search = $_GET['search'];
        $getSearch = $db->getFilesUsingDisplayFileNameSearch($search);
        while ($search = $getSearch->fetch_assoc()) {
?>
            <li class="list-group-item">
                <a href="faculty.php?page=Search&file=<?= $search['ID'] ?>" class="text-dark txt-folder-link">
                    <?= $search['DISPLAY_FILE_NAME'] ?>
                </a>
            </li>
        <?php
        }
    } elseif ($submitType == 'GetMessages') {
        $search = $_GET['search'];
        $getSearch = $admin_db->searchFileName($search);
        while ($search = $getSearch->fetch_assoc()) {
        ?>
            <li class="list-group-item">
                <a href="admin.php?page=Search&fileSearch=<?= $search['ID'] ?>" class="text-dark txt-folder-link">
                    <?= $search['DISPLAY_FILE_NAME'] ?>
                </a>
            </li>
<?php
        }
    } else {
        echo 'none';
    }
} else {
    echo 'none';
}
