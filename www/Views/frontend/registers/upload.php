<?php
  if (isset($_POST['submit']) && isset($_FILES['fontimage']) && isset($_FILES['backimage'])) {
    if ($_FILES['fontimage']['error'] > 0)
        echo "Upload lỗi rồi!";
    else {
        move_uploaded_file($_FILES['fontimage']['tmp_name'], root . '/public/upload/' . $_FILES['fontimage']['name']);
    }

    if ($_FILES['backimage']['error'] > 0)
        echo "Upload lỗi rồi!";
    else {
        move_uploaded_file($_FILES['backimage']['tmp_name'], root . '/public/upload/' . $_FILES['backimage']['name']);
    }

  }
?>