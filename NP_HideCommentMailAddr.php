<?php

/**
  * NP_HideCommentMailAddr ($Revision: 1.1 $)
  * by hsur ( http://blog.cles.jp/blog/2 )
  * 
  * $Id: NP_HideCommentMailAddr.php,v 1.1 2005/09/03 15:35:50 hsur Exp $
*/

/*
  * Copyright (C) 2004-2005 CLES. All rights reserved.
  *
  * This program is free software; you can redistribute it and/or
  * modify it under the terms of the GNU General Public License
  * as published by the Free Software Foundation; either version 2
  * of the License, or (at your option) any later version.
*/

class NP_HideCommentMailAddr extends NucleusPlugin {

    function getName()        { return 'HideCommentMailAddr';}
    function getDescription() { return '記入されたメールアドレスを隠します。ユーザがログイン状態している場合にはそのまま表示します。';}
    function getVersion()     { return '1.0';}
    function getAuthor()      { return 'cles'; }
    function getURL()         { return 'http://blog.cles.jp/blog/2';}
    
    function getMinNucleusVersion()    { return 320; }
    function getMinNucleusPatchLevel() { return 0; }
    function getEventList()            { return array('PreComment');}
    function supportsFeature($what)    { return in_array($what,array('SqlTablePrefix'));}

    function install() {
        $this->createOption('altUrl', 'Alternate URL', 'text', '', '');
    }
    
    function event_PreComment(&$data) {
        global $member;
        if ( ! $member->isLoggedIn() )
            if ( stristr($data['comment']['userlinkraw'],'mailto:') !== FALSE )
                $data['comment']['userlinkraw'] = $this->getOption('altUrl');
    }
}
