<?php
    function cryptPass($pass)
    {
        $sool = 'TeemeAsjadKordaetluuaKorda';
        $krypt = crypt($pass, $sool);
        return $krypt;
    }

