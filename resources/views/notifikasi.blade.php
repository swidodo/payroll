
<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        {{-- <meta name="description" content="Smarthr - Bootstrap Admin Template"> --}}
		{{-- <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects"> --}}
        {{-- <meta name="author" content="Dreamguys - Bootstrap Admin Template"> --}}
        <meta name="robots" content="noindex, nofollow">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title') - Pehadir</title><!-- The core Firebase JS SDK is always required and must be listed first -->
    </head>
    <body>

<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js"></script>
<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
<!-- TODO: Add SDKs for Firebase products that you want to use
    https://firebase.google.com/docs/web/setup#available-libraries -->

<script>
    $.ajaxSetup({
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
    });
    // Your web app's Firebase configuration
    var firebaseConfig = {
        apiKey: "AIzaSyDZB-o1EiE0o3VZN0fZBBUBfBpHu_v3ggk",
        authDomain: "pehadir-1f207.firebaseapp.com",
        projectId: "pehadir-1f207",
        storageBucket: "pehadir-1f207.appspot.com",
        messagingSenderId: "918999990118",
        appId: "1:918999990118:web:d6d957545d102a5c6fd2a7",
  };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);

    const messaging = firebase.messaging();

    function initFirebaseMessagingRegistration() {
        messaging.requestPermission().then(function () {
            return messaging.getToken()
        }).then(function(token) {

            $.ajax({
                url : "{{ route('fcmToken') }}",
                type : 'post',
                data : {token:token},
                dataType : 'json',
                success : function(respon){
                    console.log(respon);
                },
                error : function(){
                    alert('There is an error !, please try again')
                }
            });


        //     console.log(token)
        //     axios.post("{{ route('fcmToken') }}",{
        //         _method:"PATCH",
        //         token
        //     }).then(({data})=>{
        //         console.log(data)
        //     }).catch(({response:{data}})=>{
        //         console.error(data)
        //     })

        }).catch(function (err) {
            console.log(`Token Error :: ${err}`);
        });
    }

    initFirebaseMessagingRegistration();
  
    messaging.onMessage(function({data:{body,title}}){
        new Notification(title, {body});
    });
</script>

<script type="module">
    // Import the functions you need from the SDKs you need
    import { initializeApp } from "https://www.gstatic.com/firebasejs/10.11.1/firebase-app.js";
    import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.11.1/firebase-analytics.js";
    // TODO: Add SDKs for Firebase products that you want to use
    // https://firebase.google.com/docs/web/setup#available-libraries
  
    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    const firebaseConfig = {
      apiKey: "AIzaSyDZB-o1EiE0o3VZN0fZBBUBfBpHu_v3ggk",
      authDomain: "pehadir-1f207.firebaseapp.com",
      projectId: "pehadir-1f207",
      storageBucket: "pehadir-1f207.appspot.com",
      messagingSenderId: "918999990118",
      appId: "1:918999990118:web:d6d957545d102a5c6fd2a7",
      measurementId: "G-CE2FDSBL1L"
    };
  
    // Initialize Firebase
    const app = initializeApp(firebaseConfig);
    const analytics = getAnalytics(app);
  </script>
    </body>
</html>