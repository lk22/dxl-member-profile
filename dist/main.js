(()=>{"use strict";var e,t,n,o,a={};a.g=function(){if("object"==typeof globalThis)return globalThis;try{return this||new Function("return this")()}catch(e){if("object"==typeof window)return window}}(),(()=>{var e;a.g.importScripts&&(e=a.g.location+"");var t=a.g.document;if(!e&&t&&(t.currentScript&&(e=t.currentScript.src),!e)){var n=t.getElementsByTagName("script");n.length&&(e=n[n.length-1].src)}if(!e)throw new Error("Automatic publicPath is not supported in this browser");e=e.replace(/#.*$/,"").replace(/\?.*$/,"").replace(/\/[^\/]+$/,"/"),a.p=e})(),a.p,n=function(e){var t={};return e.serializeArray().forEach((function(e){t[e.name]=e.value})),t},o=function(e,t,n,o,a,i){jQuery.ajax({url:e,method:t,data:n,success:o,error:i,beforeSend:a})},e=jQuery,(t={init:function(){t.url=dxlMemberProfile.prefix+"/manager-profile",t.nonce=dxlMemberProfile.nonce,t.ajaxurl=dxlMemberProfile.ajaxurl,t.modals={createEventModal:e("#createEventModal"),editEventModal:e("#edit-event-modal"),editTrainingEventModal:e("#trainingEventUpdateModal"),deleteEventModal:e("#delete-event-modal"),publishEventModal:e("#publish-event-modal"),unpublishEventModal:e("#unpublish-event-modal")},t.buttons={createEventButton:e(".create-event-btn"),updateEventButton:e(".update-event-btn"),updateTrainingEventButton:e(".update-training-event-btn"),deleteEventButton:e(".delete-event-button"),publishUnpublishButton:e(".publish-unpublish-event-btn"),unpublishEventButton:e(".unpublish-event-button"),updateMemberButton:e(".update-member-btn"),createGameButton:e(".submit-add-profile-game"),deleteGameButton:e(".delete-profile-game")},t.forms={createEventForm:e(".create-event-modal-form"),updateCooperationEventForm:e(".update-cooperation-event-form"),updateTrainingEventForm:e(".update-training-event-form"),updateProfileForm:e(".update_profile_settings_form"),createGameForm:e(".dxl-profile-add-game-form")},t.actions={requestTrainerPermissions:"dxl_request_trainer_permissions",createEvent:"dxl_profile_create_event",editEvent:"dxl_profile_edit_event",deleteEvent:"dxl_profile_delete_event",publisUnpublishEvent:"dxl_profile_publish_unpublish_event",updateProfileInformation:"dxl_profile_update_profile_information",createGame:"dxl_profile_create_game",editGame:"dxl_profile_edit_game",deleteGame:"dxl_profile_delete_game"},t.bindEvents()},bindEvents:function(){e(".nav-toggler").click((function(t){console.log("clicked"),e(".nav-list").addClass("active")})),e(".close-button").click((function(t){e(".nav-list").removeClass("active")})),t.bindUpdateMember(),t.bindCreateEvent(),t.bindDeleteEvent(),t.bindUpdateCooperationEvent(),t.bindUpdateTrainingEvent(),t.bindPublishUnpublishEvent(),t.bindGameEvents()},bindCreateEvent:function(){console.log(e("select[name='event-type']").val()),e("select[name='event-type']").change((function(t){"training"===t.target.value?(e(".training-fields").removeClass("d-none"),e(".tournament-fields").addClass("d-none"),e(".cooperation-fields").addClass("d-none")):"tournament"==t.target.value?(e(".tournament-fields").removeClass("d-none"),e(".training-fields").addClass("d-none")):(e(".training-fields").addClass("d-none"),e(".tournament-fields").addClass("d-none"),e(".cooperation-fields").removeClass("d-none"))})),t.buttons.createEventButton.click((function(e){e.preventDefault();var a=n(t.forms.createEventForm);a.action=t.actions.createEvent,a.nonce=t.nonce,a.profile=dxlMemberProfile.member.user_id,console.log(a),o(t.ajaxurl,"POST",a,(function(e){console.log(e);var n=JSON.parse(e);"success"==n.status&&window.location.reload(),"error"==n.status&&console.log(n),t.buttons.createEventButton.html("Gå videre")}),(function(){t.buttons.createEventButton.html("Opretter...")}),(function(e){console.log(e),t.buttons.createEventButton.html("Gå videre")}))}))},bindDeleteEvent:function(){t.buttons.deleteEventButton.click((function(e){var n=e.currentTarget.dataset.event,a=e.currentTarget.dataset.type;o(t.ajaxurl,"POST",{action:t.actions.deleteEvent,nonce:t.nonce,event_id:n,event_type:a},(function(e){console.log(e),"success"==JSON.parse(e).status&&(window.location.href=t.url+"?module=events")}),(function(){console.log("Deleting event...")}),(function(e){console.log(e)}))}))},bindUpdateCooperationEvent:function(){t.buttons.updateEventButton.click((function(e){e.preventDefault();var a=n(t.forms.updateCooperationEventForm);a.action=t.actions.editEvent,a.nonce=t.nonce,a.type="cooperation",console.log(a),o(t.ajaxurl,"POST",a,(function(e){console.log(e);var t=JSON.parse(e);"success"==t.status&&window.location.reload(),"error"==t.status&&console.log(t)}),(function(){t.buttons.updateEventButton.html("Opdaterer...")}),(function(e){console.log(e),t.buttons.updateEventButton.html("Opdater")}))}))},bindUpdateTrainingEvent:function(){t.buttons.updateTrainingEventButton.click((function(e){e.preventDefault();var a=n(t.forms.updateTrainingEventForm);a.action=t.actions.editEvent,a.nonce=t.nonce,a.type="training",o(t.ajaxurl,"POST",a,(function(e){console.log(e);var n=JSON.parse(e);"success"==n.status&&window.location.reload(),"error"==n.status&&console.log(n),t.buttons.updateTrainingEventButton.html("Opdater"),t.modals.editTrainingEventModal.modal("hide")}),(function(){console.log("Updating event..."),t.buttons.updateTrainingEventButton.html("Opdaterer...")}),(function(e){console.log(e),t.buttons.updateTrainingEventButton.html("Opdater")}))}))},bindPublishUnpublishEvent:function(){t.buttons.publishUnpublishButton.click((function(e){console.log(e);var n=e.currentTarget.dataset.event,a=e.currentTarget.dataset.eventType,i=e.currentTarget.dataset.action;console.log(e),console.log(i),o(t.ajaxurl,"POST",{action:t.actions.publisUnpublishEvent,nonce:t.nonce,event_id:n,event_type:a,event_action:i},(function(e){console.log(e);var n=JSON.parse(e);"success"==n.status&&window.location.reload(),"failed"==n.status&&console.log(n),"publish"==i?t.buttons.publishUnpublishButton.html("Offentliggør"):t.buttons.publishUnpublishButton.html("Skjul")}),(function(){"publish"==i?t.buttons.publishUnpublishButton.html("Offentliggører event..."):t.buttons.publishUnpublishButton.html("Skjuler...")}),(function(e){console.log(e)}))}))},bindUpdateMember:function(){t.buttons.updateMemberButton.click((function(e){e.preventDefault();var a=n(t.forms.updateProfileForm);a.action=t.actions.updateProfileInformation,a.nonce=t.nonce,o(t.ajaxurl,"POST",a,(function(e){console.log(e);var n=JSON.parse(e);"error"==n.status&&console.log(n),t.buttons.updateMemberButton.attr("value","Gem")}),(function(){console.log("Updating member..."),t.buttons.updateMemberButton.attr("value","Opdaterer...")}),(function(e){console.log(e)}))}))},bindGameEvents:function(){t.buttons.createGameButton.click((function(e){e.preventDefault();var a=n(t.forms.createGameForm);a.action=t.actions.createGame,a.nonce=t.nonce,o(t.ajaxurl,"POST",a,(function(e){console.log(e),e.success&&window.location.reload(),0==e.success&&console.log(e.data.message)}),(function(){console.log("Creating game...")}),(function(e){console.log(e)}))})),t.buttons.deleteGameButton.click((function(e){e.preventDefault();var n=e.currentTarget.dataset.game,a=t.actions.deleteGame;o(t.ajaxurl,"POST",{gameId:n,action:a,nonce:t.nonce},(function(e){console.log(e),e.success?window.location.reload():console.log(e.data.message)}),(function(){console.log("Deleting game...")}),(function(e){console.log(e)}))}))}}).init()})();