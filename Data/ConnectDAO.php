<?php
include "Data/DAO.php";
$list = getAllList();
$select = 99999;
function selectUpdate()
{
    global $select;
    if (isset($_GET['idSelect'])) {
        $id = $_GET['idSelect'];
        $select = $id;
    }
}
function deleteList()
{
    global $list;
    global $conn;
    if (isset($_GET['idDelete'])) {
        $id = $_GET['idDelete'];
        $sql = "DELETE
        FROM
            `list`
        WHERE
            id = $id";
        $result = mysqli_query($conn, $sql);
        $list = getAllList();
    }
}
function updateList()
{
    global $select;
    global $list;
    global $conn;
    if (isset($_POST['btnBot'])) {
        $edit = $_POST['edit'];
        $id = $list[$select]['id'];
        $sql = "UPDATE
        `list`
    SET
        `content` = '$edit'
    WHERE
        id = $id";
        $result = mysqli_query($conn, $sql);
        $select = 99999;
        $list = getAllList();
    }
}
function getAllList()
{
    global $conn;
    $sql = "SELECT * FROM `list`";
    $result = mysqli_query($conn, $sql);
    $list = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);
    return $list;
}
function addList()
{
    global $conn;
    global $list;
    if (isset($_POST['content'])) {
        $content = $_POST['content'];
        if ($content != "") {
            $dateNow = date("Y-m-d H:i:s");
            $sql = "INSERT INTO `list`(`content`, `date`)
            VALUES('$content', '$dateNow')";
            $result = mysqli_query($conn, $sql);
            $list = getAllList();
            return $result;
        }
    }
}
