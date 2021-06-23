<?php

require_once __DIR__ . '/config.php';

function connectDb()
{
    try {
        return new PDO(
            DSN,
            USER,
            PASSWORD,
            [PDO::ATTR_ERRMODE =>
            PDO::ERRMODE_EXCEPTION]
        );
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}


function validateRequired($company, $name, $email)
{
    $errors = [];

    if ($company == '') {
        $errors[] = MSG_NO_COMPANY;
    }
    if ($name == '') {
        $errors[] = MSG_NO_NAME;
    }
    if ($email == '') {
        $errors[] = MSG_NO_EMAIL;
    }

    return $errors;
}



function insertBt($company, $name, $email)
{
    $dbh = connectDb();

    $sql = <<<EOM
    INSERT INTO
        customers
    (
        company,
        name,
        email
    )
    VALUES
    (
        :company,
        :name,
        :email
    )
    EOM;

    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':company', $company, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
}