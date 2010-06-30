<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>PyWikipediaBot Nightlies</title>
    <link rel="stylesheet" href="/~valhallasw/.style/main.css" />
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  </head>
  <body>
  <div class="body">
    <h1>PyWikipediaBot Nightlies</h1>
    <h2>Nightly downloads</h2>
    <p>The nightlies are generated every night at 20:00 UTC. There are several packages:</p>
    <!-- begin automagically generated section -->
    <?php
      $file = fopen('package/packages', 'r') or die ('Could not open package list. View <a href="log">logs</a> or <a href="package">packages</a>');
      $gendate = fgets($file);
      $package = rtrim(fgets($file));
      while (!feof($file)) {
        print '<h3>'.$package.' [<a href="package/'.$package.'/'.$package.'-nightly.tar.bz2">download</a>]</h3>';
	include('package/'.$package.'/README');
	print '<div style="margin-left: 3em; margin-right: 20%;">';
	print '<h4>Last incorporated revision</h4>';
        print '<pre>';
        include('log/'.$package.'/latest.log');
        print '</pre>';
	print '<a href="log/'.$package.'/svn.log">svn update log</a>';

	print '<h4>Downloads</h4>';
	print '<ul>';
	
	foreach (array('7z', 'tar.bz2', 'tgz', 'zip') as $ext) {
	  $filename = 'package/'.$package.'/'.$package.'-nightly.'.$ext;
	  $log = 'log/'.$package.'/'.$ext.'.log';
	  print '<li><a href="'.$filename.'">'.$filename.'</a> <small>(' . round(filesize($filename)/1024) . ' KiB, <a href="' . $log . '">log</a>)</small></li>';
	}
        print '</ul>or alternatively, browse the <a href="package/'.$package.'">'.$package.' package directory</a>';
       
	print '</div>';
        $package = rtrim(fgets($file));
      }
    ?><!-- end automagically created stuff -->
    <h2>FAQ</h2>
    <ul>
      <li>
        Q: How can I use the framework?<br/>
        A: Read the <a href="http://meta.wikimedia.org/wiki/Using_the_python_wikipediabot">manual</a>
      </li>
      <li>
        Q: OMG BUG!!!!!!1111oneoneone<br/>
        A: Report them at the <a href="http://sourceforge.net/tracker/?atid=603138&amp;group_id=93107&amp;func=browse">bug tracker</a>
      </li>
      <li>
        Q: I've got a support or feature request, or a patch<br/>
        A: <a href="http://sourceforge.net/tracker/?atid=603139&amp;group_id=93107&amp;func=browse">Support requests</a>, <a href="http://sourceforge.net/tracker/?atid=603141&amp;group_id=93107&amp;func=browse">Feature requests</a>, <a href="http://sourceforge.net/tracker/?atid=603140&amp;group_id=93107&amp;func=browse">Patches</a>. Or join us on irc: <a href="irc://irc.freenode.net/pywikipediabot">#pywikipediabot on freenode</a>.
      </li>
      <li>
        Q: I want to stay updated<br/>
        A: Subscribe to the <a href="https://lists.wikimedia.org/mailman/listinfo/pywikipedia-l">mailing list</a>, join us on <a           href="irc://irc.freenode.net/pywikipediabot">IRC</a>.
      </li>
    </ul>
    <div>
      <div style="float:right; margin-top: 3px;">
       <a href="http://validator.w3.org/check?uri=referer" style="border-bottom: none;">
         <img src="http://www.w3.org/Icons/valid-xhtml10-blue" alt="Valid XHTML 1.0 Strict" height="31" width="88" />
       </a>
      </div>
      <p class="footer">
        Latest pywikipedia nightly was generated at: <? echo $gendate; ?><br/>Web site revision: <? include("../.git/latest"); ?>
      </p>
    </div>
  </div>
  </body>
</html>
