<template>
    <div class="p-5">
        <h1 class="text-2xl mb-4">Room:  {{ room_code }}</h1>
        <div class="grid grid-flow-row grid-cols-3 grid-rows-3 gap-4 bg-black/]">
            <div id="my-video-chat-window"></div>
        </div>
    </div>
</template>

<script>
const DOMAIN_URL = "https://ihtmam.com/video-conf/public";
 // const DOMAIN_URL = "http://127.0.0.1:8000";

import { connect, createLocalTracks, createLocalVideoTrack } from 'twilio-video';


export default {
    name: 'video-chat',
    props: ['room_code', 'user_id'],
    data: function () {
        return {
            accessToken: '',
        }
    },
    methods : {
        getAccessToken : function () {
            const _this = this
            const axios = require('axios')

            // Request a new token
            axios.get(DOMAIN_URL+'/api/access_token')
                .then(function (response) {
                    _this.accessToken = response.data
                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(function () {
                    _this.joinRoom()
                });
        },
        joinRoom() {
            /*createLocalTracks({
                audio: true,
                video: { width: 350 }
            }).then(localTracks => {
                return connect(this.accessToken, {
                    name: this.room_code,
                    tracks: localTracks
                });
            })*/
            connect(this.accessToken, {
                audio: true,
                name: this.room_code,
                video: { width: 300 }
            }).then(room => {
                console.log(`Successfully joined a Room: ${room}`);

                const videoChatWindow = document.getElementById('video-chat-window');
                createLocalVideoTrack().then(track => {
                    videoChatWindow.appendChild(track.attach());
                });

                room.participants.forEach(this.participantConnected);
                room.on('participantConnected', this.participantConnected);

                room.on('participantDisconnected', this.participantDisconnected);

                room.once('disconnected', error => room.participants.forEach(this.participantDisconnected));

            }, error => {
                console.error(`Unable to connect to Room: ${error.message}`);
            });
        },
        participantConnected(participant) {
            console.log('Participant "%s" connected', participant.identity);
            /*const div = document.createElement('div');
            div.id = participant.sid;
            div.setAttribute("style", "float: left; margin: 10px;");
            div.innerHTML = "<div style='clear:both'>" +participant.identity+ "</div>";
            participant.tracks.forEach(function(track) {
                trackAdded(div, track)
            });
            participant.on('trackAdded', function(track) {
                trackAdded(div, track)
            });
            participant.on('trackRemoved', trackRemoved);
            document.getElementById('media-div').appendChild(div);*/
            console.log('Participant "%s" connected', participant.identity);

            const div = document.createElement('div');
            div.id = participant.sid;
            div.innerText = participant.identity;

            participant.on('trackSubscribed', track => this.trackSubscribed(div, track));
            participant.on('trackUnsubscribed', this.trackUnsubscribed);

            participant.tracks.forEach(publication => {
                if (publication.isSubscribed) {
                    this.trackSubscribed(div, publication.track);
                }
            });

            document.body.appendChild(div);
        },
        participantDisconnected(participant) {
            console.log('Participant "%s" disconnected', participant.identity);
            document.getElementById(participant.sid).remove();
        },

        trackSubscribed(div, track) {
            div.appendChild(track.attach());
        },
        trackUnsubscribed(track) {
            track.detach().forEach(element => element.remove());
        },

        connectToRoom() {
            connect(this.accessToken, {
                    name: this.room_code,
                    audio: true,
                    video: true,
                }).then(room => {
                console.log(`Successfully joined a Room: ${room}`);
                const videoChatWindow = document.getElementById('video-chat-window');
                createLocalVideoTrack().then(track => {
                    videoChatWindow.appendChild(track.attach());
                });
                room.on('participantConnected', participant => {
                    console.log(`A remote Participant connected: ${participant}`);
                });
            }, error => {
                console.error(`Unable to connect to Room: ${error.message}`);
            });
        },

        /*connectToRoom : function () {
            let vm = this;

            const { connect, createLocalVideoTrack } = require('twilio-video');
            connect( this.accessToken, { name:'cool room' }).then(room => {
                console.log(`Successfully joined a Room: ${room}`);
                const videoChatWindow = document.getElementById('video-chat-window');
                createLocalVideoTrack().then(track => {
                    videoChatWindow.appendChild(track.attach());
                });
                room.on('participantConnected', participant => {
                    console.log(`Participant "${participant.identity}" connected`);
                    participant.tracks.forEach(publication => {
                        if (publication.isSubscribed) {
                            const track = publication.track;
                            videoChatWindow.appendChild(track.attach());
                        }
                    });
                    participant.on('trackSubscribed', track => {
                        videoChatWindow.appendChild(track.attach());
                    });
                });
                room.on('participantDisconnected', function(participant) {
                    console.log("Disconnected: '"+participant.identity+"'");
                    vm.participantDisconnected(participant);
                });

            }, error => {
                console.error(`Unable to connect to Room: ${error.message}`);
            });
        },*/

    },
    mounted : function () {
        console.log('Video chat room loading...')

        this.getAccessToken()
    },
    created() {

    }
}
</script>
