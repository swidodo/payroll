importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
   
firebase.initializeApp({
    apiKey: "AIzaSyDZB-o1EiE0o3VZN0fZBBUBfBpHu_v3ggk",
    projectId: "pehadir-1f207",
    messagingSenderId: "918999990118",
    appId: "1:918999990118:web:d6d957545d102a5c6fd2a7",
    appId: "1:918999990118:ios:fb29a80074b6d3356fd2a7",
    appId: "1:918999990118:android:c17cbe47a388ed896fd2a7",
});
  
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function({data:{title,body,icon}}) {
    return self.registration.showNotification(title,{body,icon});
});