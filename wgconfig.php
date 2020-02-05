#!/usr/bin/php
<?php

function ClientConfig($strInterfaceAddress, $strPrivateKey, $strPublicKey, $strEndPoint, $strEndPointPort, $strAllowedIPs) {
    echo "[Interface]".PHP_EOL;
    echo "Address = ".$strInterfaceAddress.PHP_EOL;   
    echo "PrivateKey = ".$strPrivateKey.PHP_EOL;

    echo "[Peer]".PHP_EOL;
    echo "PublicKey = ".$strPublicKey.PHP_EOL;
    echo "Endpoint = ".$strEndPoint.":".$strEndPointPort.PHP_EOL;
    echo "AllowIPs = ".$strAllowedIPs.PHP_EOL;
    echo "PersistentKeepalive = 21".PHP_EOL;
}

function ServerInterface($strInterfaceAddress, $strNetworkAdapter, $strListenPort, $strPrivateKey) {
    echo "[Interface]".PHP_EOL;
    echo "Address = ".$strInterfaceAddress.PHP_EOL;
    echo "PostUp = iptables -A FORWARD -i %i -j ACCEPT; iptables -A FORWARD -o %i -j ACCEPT; iptables -t nat -A POSTROUTING -o ".$strNetworkAdapter." -j MASQUERADE ".PHP_EOL;
    echo "PostDown = iptables -D FORWARD -i %i -j ACCEPT; iptables -D FORWARD -o %i -j ACCEPT; iptables -t nat -D POSTROUTING -o ".$strNetworkAdapter."  -j MASQUERADE ".PHP_EOL;
    echo "ListenPort = ",$strListenPort.PHP_EOL;
    echo "PrivateKey = ".$strPrivateKey.PHP_EOL;
}
function ServerPeer($strPublicKey, $strAllowedIPs) {
    echo "[Peer]".PHP_EOL;
    echo "PublicKey = ".$strPublicKey.PHP_EOL;
    echo "AllowedIPs = ".$strAllowedIPs.PHP_EOL;
    echo "PersistentKeepalive = 21".PHP_EOL;
}


//ClientConfig(" Test1", "Test2", "Test3", "Test4", "Test5", "Test6");
//ServerInterface(" Test1", "Test2", "Test3", "Test4", "Test5");
//ServerPeer(" Test1", "Test2");


?>