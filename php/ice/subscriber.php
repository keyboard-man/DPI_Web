<?php
// **********************************************************************
//
// Copyright (c) 2003-2011 ZeroC, Inc. All rights reserved.
//
// This copy of Ice is licensed to you under the terms described in the
// ICE_LICENSE file included in this distribution.
//
// **********************************************************************
//
// Ice version 3.4.2
//
// <auto-generated>
//
// Generated from file `subscriber.ice'
//
// Warning: do not edit this file.
//
// </auto-generated>
//


if(!isset($Subs__t_McnnSrvTypeVector))
{
    $Subs__t_McnnSrvTypeVector = IcePHP_defineSequence('::Subs::McnnSrvTypeVector', $IcePHP__t_int);
}

if(!class_exists('Subs_MANACTION'))
{
    class Subs_MANACTION
    {
        const ADD = 0;
        const DEL = 1;
        const EDI = 2;
    }

    $Subs__t_MANACTION = IcePHP_defineEnum('::Subs::MANACTION', array('ADD', 'DEL', 'EDI'));
}

if(!class_exists('Subs_PubSubDpi'))
{
    class Subs_PubSubDpi
    {
        public function __construct($id='', $ip='', $port='', $manType=Subs_MANACTION::ADD)
        {
            $this->id = $id;
            $this->ip = $ip;
            $this->port = $port;
            $this->manType = $manType;
        }

        public function __toString()
        {
            global $Subs__t_PubSubDpi;
            return IcePHP_stringify($this, $Subs__t_PubSubDpi);
        }

        public $id;
        public $ip;
        public $port;
        public $manType;
    }

    $Subs__t_PubSubDpi = IcePHP_defineStruct('::Subs::PubSubDpi', 'Subs_PubSubDpi', array(
        array('id', $IcePHP__t_string), 
        array('ip', $IcePHP__t_string), 
        array('port', $IcePHP__t_string), 
        array('manType', $Subs__t_MANACTION)));
}

if(!isset($Subs__t_ManDpiVector))
{
    $Subs__t_ManDpiVector = IcePHP_defineSequence('::Subs::ManDpiVector', $Subs__t_PubSubDpi);
}

if(!interface_exists('Subs_McnnSubs'))
{
    interface Subs_McnnSubs
    {
        public function subsMcnnSrvInfo($nodeId, $srvType);
        public function subsDpiInfo($dpi);
        public function subsStatInfo();
    }

    class Subs_McnnSubsPrxHelper
    {
        public static function checkedCast($proxy, $facetOrCtx=null, $ctx=null)
        {
            return $proxy->ice_checkedCast('::Subs::McnnSubs', $facetOrCtx, $ctx);
        }

        public static function uncheckedCast($proxy, $facet=null)
        {
            return $proxy->ice_uncheckedCast('::Subs::McnnSubs', $facet);
        }
    }

    $Subs__t_McnnSubs = IcePHP_defineClass('::Subs::McnnSubs', 'Subs_McnnSubs', true, $Ice__t_Object, null, null);

    $Subs__t_McnnSubsPrx = IcePHP_defineProxy($Subs__t_McnnSubs);

    IcePHP_defineOperation($Subs__t_McnnSubs, 'subsMcnnSrvInfo', 0, 0, array($IcePHP__t_string, $Subs__t_McnnSrvTypeVector), null, null, null);
    IcePHP_defineOperation($Subs__t_McnnSubs, 'subsDpiInfo', 0, 0, array($Subs__t_ManDpiVector), null, null, null);
    IcePHP_defineOperation($Subs__t_McnnSubs, 'subsStatInfo', 0, 0, null, null, null, null);
}
?>
