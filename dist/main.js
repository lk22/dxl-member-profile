(()=>{"use strict";var e,t,n,o={};o.g=function(){if("object"==typeof globalThis)return globalThis;try{return this||new Function("return this")()}catch(e){if("object"==typeof window)return window}}(),(()=>{var e;o.g.importScripts&&(e=o.g.location+"");var t=o.g.document;if(!e&&t&&(t.currentScript&&(e=t.currentScript.src),!e)){var n=t.getElementsByTagName("script");n.length&&(e=n[n.length-1].src)}if(!e)throw new Error("Automatic publicPath is not supported in this browser");e=e.replace(/#.*$/,"").replace(/\?.*$/,"").replace(/\/[^\/]+$/,"/"),o.p=e})(),o.p,n=function(e,t,n,o,r,i){jQuery.ajax({url:e,method:t,data:n,success:o,error:i,beforeSend:r})},console.log(dxlMemberProfile.member),e=jQuery,(t={init:function(){t.nonce=dxlMemberProfile.nonce,t.ajaxurl=dxlMemberProfile.ajaxurl,t.modals={createEventModal:e("#createEventModal"),editEventModal:e("#edit-event-modal"),deleteEventModal:e("#delete-event-modal"),publishEventModal:e("#publish-event-modal"),unpublishEventModal:e("#unpublish-event-modal")},t.buttons={createEventButton:e(".create-event-btn"),editEventButton:e(".edit-event-button"),deleteEventButton:e(".delete-event-button"),publishEventButton:e(".publish-event-button"),unpublishEventButton:e(".unpublish-event-button")},t.forms={createEventForm:e(".create-event-modal-form")},t.actions={requestTrainerPermissions:"dxl_request_trainer_permissions",createEvent:"dxl_profile_create_event",editEvent:"dxl_profile_edit_event",deleteEvent:"dxl_profile_delete_event",publishEvent:"dxl_profile_publish_event",unpublishEvent:"dxl_profile_unpublish_event",updateProfileInformation:"dxl_profile_update_profile_information",createGame:"dxl_profile_create_game",editGame:"dxl_profile_edit_game",deleteGame:"dxl_profile_delete_game"},t.bindEvents()},bindEvents:function(){t.bindCreateEvent(),t.bindRequestTrainerPermissions()},bindCreateEvent:function(){console.log(e("select[name='event-type']").val()),e("select[name='event-type']").change((function(t){"training"===t.target.value?(e(".training-fields").removeClass("d-none"),e(".tournament-fields").addClass("d-none"),e(".cooperation-fields").addClass("d-none")):"tournament"==t.target.value?(e(".tournament-fields").removeClass("d-none"),e(".training-fields").addClass("d-none")):(e(".training-fields").addClass("d-none"),e(".tournament-fields").addClass("d-none"),e(".cooperation-fields").removeClass("d-none"))})),t.buttons.createEventButton.click((function(e){e.preventDefault();var o=function(e){var t={};return e.serializeArray().forEach((function(e){t[e.name]=e.value})),t}(t.forms.createEventForm);o.action=t.actions.createEvent,o.nonce=t.nonce,o.profile=dxlMemberProfile.member.user_id,console.log(o),n(t.ajaxurl,"POST",o,(function(e){console.log(e);var n=JSON.parse(e);"success"==n.status&&window.location.reload(),"error"==n.status&&console.log(n),t.buttons.createEventButton.html("Gå videre")}),(function(){t.buttons.createEventButton.html("Opretter...")}),(function(e){console.log(e),t.buttons.createEventButton.html("Gå videre")}))}))},bindRequestTrainerPermissions:function(){e("#request-trainer-permissions").on("click",(function(e){e.preventDefault(),n(t.ajaxUrl,"POST",{action:t.actions.requestTrainerPermissions,nonce:t.nonce},(function(e){console.log(e)}),(function(e){console.log(e)}),(function(){console.log("before send")}))}))}}).init()})();