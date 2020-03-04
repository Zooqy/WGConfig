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


//main program starts here

//ClientConfig(" Test1", "Test2", "Test3", "Test4", "Test5", "Test6");
//ServerInterface(" Test1", "Test2", "Test3", "Test4", "Test5");
//ServerPeer(" Test1", "Test2");
$shortopts="";
$shortopts .= "h::";
$shortopts .= "s::";
$shortopts .= "c::";
$longopts  = array(
    "address::",       // This is for the server address
    "listenport::",    // This is the server Port 
    "privatekey::",    // This is for private keys
    "allowedips::",    // This is to show allowedip's
    "publickey::",     // This is to show the public key
    "nic::",           // This is to show the network interface card
    "endpoint::"       // This is to show the target host 
);
$options = getopt($shortopts, $longopts);

var_dump($options);

$clientmode=0;
$servermode=0;

if (array_key_exists('c',$options)) {
        echo "-c was specified.  innit. ".PHP_EOL;
        $clientmode=1;
}


if (array_key_exists('s',$options)) {
    echo "-s was specified.  innit. ".PHP_EOL;
    $servermode=1;
}

$total=$clientmode+$servermode

?> 