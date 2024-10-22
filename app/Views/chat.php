<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SISTEM GUDANG</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url('css/bootstrap.min.css'); ?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?= base_url('css/metisMenu.min.css'); ?>" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?= base_url('css/timeline.css'); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= base_url('css/startmin.css'); ?>" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?= base_url('css/morris.css'); ?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?= base_url('css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">

    <!-- WhatsApp Style CSS -->
    <style>
        body {
            display: flex;
            flex-direction: column;
            height: 100vh;
            background-color: #e5ddd5;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        #page-wrapper {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            background-color: #ffffff;
            margin: 10px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #chat-container {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            border-radius: 10px;
            padding: 20px;
        }

        #chat-messages {
            flex-grow: 1;
            overflow-y: auto;
            padding: 20px;
            background-color: #e5ddd5;
            border-radius: 10px 10px 0 0;
            display: flex;
            flex-direction: column;
        }

        .message {
            margin-bottom: 10px;
            padding: 10px 20px;
            border-radius: 7.5px;
            max-width: 100%;
            word-wrap: break-word;
            display: inline-block;
        }

        .message-left {
            background-color: #f0f0f0;
            align-self: flex-start;
        }

        .message-right {
            background-color: #DCF8C6;
            align-self: flex-end;
            text-align: right;
        }

        .message-content p {
            margin: 3px 0;
            font-size: 14px;
        }

        .message-timestamp {
            font-size: 12px;
            color: #888;
        }

        .form-group {
            display: flex;
            background-color: #f0f0f0;
            padding: 10px;
            border-radius: 0 0 10px 10px;
        }

        .form-group input {
            flex-grow: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
        }

        .form-group button {
            padding: 5px 20px;
        }
    </style>

</head>

<body>

    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?= base_url('dashboard'); ?>">Kembali</a>
            </div>

            <ul class="nav navbar-right navbar-top-links">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <?= session()->get('username'); ?> <b class="caret"></b>
                    </a>

                    <ul class="dropdown-menu dropdown-user">
                        <li>
                            <a href="logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- /.navbar-top-links -->
        </nav>


        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Chat Messages</h1>
                    </div>
                </div>

                <div id="chat-container">
                    <!-- Tampilan pesan chat -->
                    <div id="chat-messages">
                        <?php foreach ($data as $d): ?>
                            <div class="message <?= ($d['username'] == session()->get('username')) ? 'message-right' : 'message-left'; ?>">
                                <div class="message-content">
                                    <p><strong><?= $d['username']; ?></strong></p>
                                    <p><?= $d['message']; ?></p>
                                    <span class="message-timestamp"><?= $d['timestamp']; ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Form untuk mengirim pesan -->
                    <form action="<?= base_url('chat/sendMessage'); ?>" method="post" class="form-group">
                        <!-- Input hidden untuk menyimpan username -->
                        <input type="hidden" id="username" name="username" value="<?= session()->get('username'); ?>">

                        <input type="text" class="form-control" id="message" name="message" placeholder="Ketik Pesan" required autocomplete="off">
                        <button type="submit" class="btn btn-success">Kirim</button>
                    </form>
                </div>

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?= base_url('js/jquery.min.js'); ?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?= base_url('js/bootstrap.min.js'); ?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?= base_url('js/metisMenu.min.js'); ?>"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?= base_url('js/raphael.min.js'); ?>"></script>
    <script src="<?= base_url('js/morris.min.js'); ?>"></script>
    <script src="<?= base_url('js/morris-data.js'); ?>"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?= base_url('js/startmin.js'); ?>"></script>

    <script>
        // Scroll to the bottom of the chat messages container
        document.addEventListener("DOMContentLoaded", function() {
            var chatMessages = document.getElementById('chat-messages');
            chatMessages.scrollTop = chatMessages.scrollHeight;
        });
    </script>
</body>

</html>
