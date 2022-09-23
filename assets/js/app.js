const $ = jQuery;
const requestUtility = require('./utilities/request');
console.log(dxlMemberProfile.member);
$(document).ready(function() {
  const settings = {
    
  }

   $.fn.extend(settings); // Add your code here

  const profile = {
    init: () => {
      profile.requestUtility = requestUtility;
      profile.nonce = dxlMemberProfile.nonce;
      profile.modals = {
        createEventModal: $('#create-event-modal'),
        editEventModal: $('#edit-event-modal'),
        deleteEventModal: $('#delete-event-modal'),
        publishEventModal: $('#publish-event-modal'),
        unpublishEventModal: $('#unpublish-event-modal'),
      }

      profile.actions = {
        requestTrainerPermissions: 'dxl_request_trainer_permissions',
        createEvent: 'dxl_profile_create_event',
        editEvent: 'dxl_profile_edit_event',
        deleteEvent: 'dxl_profile_delete_event',
        publishEvent: 'dxl_profile_publish_event',
        unpublishEvent: 'dxl_profile_unpublish_event',
        updateProfileInformation: 'dxl_profile_update_profile_information',
        createGame: 'dxl_profile_create_game',
        editGame: 'dxl_profile_edit_game',
        deleteGame: 'dxl_profile_delete_game',
      }
      
      profile.bindEvents();
    },

    /**
     * Bind all profile events
     */
    bindEvents: () => {
      profile.bindRequestTrainerPermissions();
    },
    
    /**
     * Bind request trainer permissions action
     */
    bindRequestTrainerPermissions: () => {
      $('#request-trainer-permissions').on('click', function(e) {
        e.preventDefault();
        profile.requestUtility.ajaxRequest(profile.ajaxUrl, 'POST', {
          action: profile.actions.requestTrainerPermissions,
          nonce: profile.nonce
        }, (response) => {
          console.log(response);
        }, (error) => {
          console.log(error);
        }, () => {
          console.log('before send');
        });
      });
    }
  };

  });