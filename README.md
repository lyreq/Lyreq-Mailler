# Welcome to LyreqMailler!
What can we do with LyreqMailler? Why does LyreqMailler exist? For easy to use on Php Mailler .You are getting rid of from writing pages of code with LyreqMailler. Just use mailSend function and its parameters. So you can easily send an email. This is structure just for text mail. You can't use with attachment. I will develop coming soon for attachment.

**How can i use LyreqMailler ?**

	include  'lyreqmailler.php';
	$Lyreq =  new  LyreqMailler(port, "host", "mail", "pass");
If you want tls setting to use , you must use in this way.

	include  'lyreqmailler.php';
    $Lyreq =  new  LyreqMailler(port, "host", "mail", "pass",true);

And send mail

    $mailSend = $Lyreq->mailSend("senderName", "receiverName", "receiverMail", "subject", "body");
    if ($mailSend['status'] ==  true) {
    echo  "Mail Send.";
    } else {
    echo $mailSend['messages'];
    }
If you meet the mistake, you can create issue. I will fix it on my free time.

