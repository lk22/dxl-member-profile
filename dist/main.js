(()=>{"use strict";var e,t,n,o,i={};i.g=function(){if("object"==typeof globalThis)return globalThis;try{return this||new Function("return this")()}catch(e){if("object"==typeof window)return window}}(),(()=>{var e;i.g.importScripts&&(e=i.g.location+"");var t=i.g.document;if(!e&&t&&(t.currentScript&&(e=t.currentScript.src),!e)){var n=t.getElementsByTagName("script");n.length&&(e=n[n.length-1].src)}if(!e)throw new Error("Automatic publicPath is not supported in this browser");e=e.replace(/#.*$/,"").replace(/\?.*$/,"").replace(/\/[^\/]+$/,"/"),i.p=e})(),i.p,n=function(e){var t={};return e.serializeArray().forEach((function(e){t[e.name]=e.value})),t},o=function(e,t,n,o,i,r){jQuery.ajax({url:e,method:t,data:n,success:o,error:r,beforeSend:i})},e=jQuery,(t={init:function(){t.nonce=dxlMemberProfile.nonce,t.ajaxurl=dxlMemberProfile.ajaxurl,t.modals={createEventModal:e("#createEventModal"),editEventModal:e("#edit-event-modal"),deleteEventModal:e("#delete-event-modal"),publishEventModal:e("#publish-event-modal"),unpublishEventModal:e("#unpublish-event-modal")},t.buttons={createEventButton:e(".create-event-btn"),updateEventButton:e(".update-event-btn"),deleteEventButton:e(".delete-event-button"),publishUnpublishButton:e(".publish-unpublish-event-btn"),unpublishEventButton:e(".unpublish-event-button")},t.forms={createEventForm:e(".create-event-modal-form"),updateCooperationEventForm:e(".update-cooperation-event-form")},t.actions={requestTrainerPermissions:"dxl_request_trainer_permissions",createEvent:"dxl_profile_create_event",editEvent:"dxl_profile_edit_event",deleteEvent:"dxl_profile_delete_event",publisUnpublishEvent:"dxl_profile_publish_unpublish_event",updateProfileInformation:"dxl_profile_update_profile_information",createGame:"dxl_profile_create_game",editGame:"dxl_profile_edit_game",deleteGame:"dxl_profile_delete_game"},t.bindEvents()},bindEvents:function(){t.bindCreateEvent(),t.bindUpdateCooperationEvent(),t.bindPublishUnpublishEvent(),t.bindRequestTrainerPermissions()},bindCreateEvent:function(){console.log(e("select[name='event-type']").val()),e("select[name='event-type']").change((function(t){"training"===t.target.value?(e(".training-fields").removeClass("d-none"),e(".tournament-fields").addClass("d-none"),e(".cooperation-fields").addClass("d-none")):"tournament"==t.target.value?(e(".tournament-fields").removeClass("d-none"),e(".training-fields").addClass("d-none")):(e(".training-fields").addClass("d-none"),e(".tournament-fields").addClass("d-none"),e(".cooperation-fields").removeClass("d-none"))})),t.buttons.createEventButton.click((function(e){e.preventDefault();var i=n(t.forms.createEventForm);i.action=t.actions.createEvent,i.nonce=t.nonce,i.profile=dxlMemberProfile.member.user_id,console.log(i),o(t.ajaxurl,"POST",i,(function(e){console.log(e);var n=JSON.parse(e);"success"==n.status&&window.location.reload(),"error"==n.status&&console.log(n),t.buttons.createEventButton.html("Gå videre")}),(function(){t.buttons.createEventButton.html("Opretter...")}),(function(e){console.log(e),t.buttons.createEventButton.html("Gå videre")}))}))},bindUpdateCooperationEvent:function(){t.buttons.updateEventButton.click((function(e){e.preventDefault();var i=n(t.forms.updateCooperationEventForm);i.action=t.actions.editEvent,i.nonce=t.nonce,i.type="cooperation",console.log(i),o(t.ajaxurl,"POST",i,(function(e){console.log(e);var t=JSON.parse(e);"success"==t.status&&window.location.reload(),"error"==t.status&&console.log(t)}),(function(){t.buttons.updateEventButton.html("Opdaterer...")}),(function(e){console.log(e),t.buttons.updateEventButton.html("Opdater")}))}))},bindPublishUnpublishEvent:function(){t.buttons.publishUnpublishButton.click((function(e){console.log(e);var n=e.currentTarget.dataset.event,i=e.currentTarget.dataset.eventType,r=e.currentTarget.dataset.action;console.log(e),console.log(r),o(t.ajaxurl,"POST",{action:t.actions.publisUnpublishEvent,nonce:t.nonce,event_id:n,event_type:i,event_action:r},(function(e){console.log(e);var n=JSON.parse(e);"success"==n.status&&window.location.reload(),"failed"==n.status&&console.log(n),"publish"==r?t.buttons.publishUnpublishButton.html("Offentliggør"):t.buttons.publishUnpublishButton.html("Skjul")}),(function(){"publish"==r?t.buttons.publishUnpublishButton.html("Offentliggører event..."):t.buttons.publishUnpublishButton.html("Skjuler...")}),(function(e){console.log(e)}))}))},bindRequestTrainerPermissions:function(){e("#request-trainer-permissions").on("click",(function(e){e.preventDefault(),o(t.ajaxUrl,"POST",{action:t.actions.requestTrainerPermissions,nonce:t.nonce},(function(e){console.log(e)}),(function(e){console.log(e)}),(function(){console.log("before send")}))}))}}).init()})();