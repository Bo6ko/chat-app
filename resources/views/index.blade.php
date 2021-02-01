@extends('layouts.app')
@section('title', 'Home')
@section('content')

Welcome {{ $data['user_email'] }} 
</br></br></br>
<textarea name="message_text" rows=5 cols=100></textarea>
<div class="clear"></clear>
<div class="send_message">Send Message</div>

<h1>Messages:</h1>
<div class="message-box">

    @foreach ($messages as $message)
        <h4>Hour: {{ date('H:i A', strtotime($message->message_create_date)) }}, Username: {{$message->user_name}}</h4>
        <div class="message">
        {{ $message->message_text }}
        </div>
    @endforeach

</div>

<script>

$(document).ready(function() {
    setInterval(function() {
        let message_box   = $('.message-box');
        $.ajax({
                type:'POST',
                url:"{{ route('getAllMessage.post') }}",
                success:function(data){

                    let str = '';
                    let message_date = '';
                    let message_minutes = '';
                    $.each( data.messages, function( key, message ) {
                        message_date = new Date( message.message_create_date );
                        message_minutes = message_date.getMinutes();
                        if (message_minutes < 10) {
                            message_minutes = '0'+message_minutes;
                        }
                        str += '<h4>Hour: ' + message_date.getHours() + ':' + message_minutes +' Username: ' + message.user_name + '</h4>';
                        str += '<div class="message">' + message.message_text + '</div>';  
                    }); 
                    $(message_box).html(str);
                    console.log(data);
                    console.log(data.messages[0].message_text);
                }
        });
    }, 5000);

    $('.send_message').on('click', function() {

        let message_text = $('textarea[name="message_text"]').val().trim();
        let message_box   = $('.message-box');

        $.ajax({
                type:'POST',
                url:"{{ route('createMessage.post') }}",
                data:{
                    message_text: message_text
                },
                success:function(data){
                    $(message_box).prepend('<div class="message">' + data.message_text + '</div>');
                    $(message_box).prepend('<h4>Hour: ' + data.message_date + ' Username: ' + data.user[0].user_name + '</h4>');
                }
        });
    });
});    
</script>

@endsection