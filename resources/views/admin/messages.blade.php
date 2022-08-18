<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/user/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/user/style.css')}}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>



        /*#messages {*/
        /*     height:88vh;*/
        /*     overflow-x:hidden;*/
        /*     padding:10px;*/

        /*}*/

        /*form {*/
        /*    display:flex;*/
        /*    margin-top:1000px;*/
        /*}*/
        /*input {*/
        /*    font-size:1.2rem;*/
        /*    padding:10px;*/
        /*    margin :10px 5px;*/
        /*    appearance:none;*/
        /*    -webkit-appearance:none;*/
        /*    border:1px solid #ccc;*/
        /*    border-radius:5px;*/

        /*}*/
        /*#message {*/
        /*    flex:2;*/
        /*}*/

    </style>
    <title>Messages</title>
</head>
<body class="body" >





<!--Code here-->
<!--<div id="messages" style="background-image: url('{{ asset('assets/img/chat1.png')}}');">-->
<!--     <form>-->
<!--       <input type="text" id="message" name="message" autocomplete="off" autofocus placeholder="Type Message...........">  -->
<!--       <input type="submit" value="Send">-->
<!--     </form>-->
<!--</div>-->


<br><br>
<div class="row" style="margin:0">
    <div class="col-xs-12">
        <table class="table table-bordered">
            <tr>

                <th style="text-align: center; background-color: skyblue">role</th>
                <th style="text-align: center; background-color: skyblue">username</th>
                <th style="text-align: center; background-color: skyblue">Action</th>



            </tr>
            @php
                $i=0;
            @endphp
            @foreach($users as $user)
                <tr style="text-align: center">
                    <td style="background-color: rgba(128, 128, 128, 0.185)">User</td>
                    <td style="background-color: rgba(128, 128, 128, 0.096)">{{$user->name}}  <span class="label label-success">{{$counts[$i]}}</span></td>
                    <td style="background-color: rgba(128, 128, 128, 0.096)"> <button type="button" class="btn btn-info btn-xs start_chat" data-touserid="{{$user->id}}" data-tousername="{{$user->name}}">Start Chat</button></td>
                </tr>
                @php
                    $i++;
                @endphp
            @endforeach
        </table>
    </div>

    <div id="user_details"></div>
    <div id="user_model_details"></div>



</div>




<br><br> <br><br> <br><br> <br><br> <br><br> <br><br>




<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    window.Laravel = {!! json_encode([
           'csrfToken' => csrf_token(),
       ]) !!};
</script>
<script>




    $(document).ready(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),

            }
        });

        setInterval(function(){


            update_chat_history_data();

        }, 5000);





        function make_chat_dialog_box(to_user_id, to_user_name)
        {
            var modal_content = '<div id="user_dialog_'+to_user_id+'" class="user_dialog" title="You have chat with '+to_user_name+'">';
            modal_content += '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">';
            modal_content += fetch_user_chat_history(to_user_id);
            modal_content += '</div>';
            modal_content += '<div class="form-group">';
            modal_content += '<textarea name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="form-control"></textarea>';
            modal_content += '</div><div class="form-group" align="right">';
            modal_content+= '<button type="button" name="send_chat" id="'+to_user_id+'" class="btn btn-info send_chat">Send</button></div></div>';
            $('#user_model_details').html(modal_content);
        }

        $(document).on('click', '.start_chat', function(){

            var to_user_id = $(this).data('touserid');
            var to_user_name = $(this).data('tousername');
            make_chat_dialog_box(to_user_id, to_user_name);

            $("#user_dialog_"+to_user_id).dialog({
                autoOpen:false,
                width:400,
                height:500
            });
            $('#user_dialog_'+to_user_id).dialog('open');

        });


        var  action_url = "{{ route('admin-chat2') }}";
        $(document).on('click', '.send_chat', function(){
            var to_user_id = $(this).attr('id');
            var chat_message = $('#chat_message_'+to_user_id).val();
            var token = "{{ csrf_token() }}";
            $.ajax({
                url: action_url,
                method:"POST",

                data:{to_user_id:to_user_id, chat_message:chat_message, _token:token},

                success:function(data)
                {
                    $('#chat_message_'+to_user_id).val('');
                    $('#chat_history_'+to_user_id).html(data.result);
                }
            });

        });


        function fetch_user_chat_history(to_user_id)
        {

            var  action_url = "{{ route('admin-fetch-user-history2') }}";
            var token = "{{ csrf_token() }}";

            $.ajax({
                url:action_url,
                method:"POST",

                data:{to_user_id:to_user_id,_token:token},
                success:function(data){
                    $('#chat_history_'+to_user_id).html(data.result);
                }
            })
        }

        function update_chat_history_data()
        {
            $('.chat_history').each(function(){
                var to_user_id = $(this).data('touserid');
                fetch_user_chat_history(to_user_id);
            });
        }



    });



</script>


</body>
</html>
