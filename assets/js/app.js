import { getFormValues, ajaxRequest } from "./utilities";

(($) => {
  const profile = {
    init: () => {
      // profile.profileUtility = profileUtility;
      profile.nonce = dxlMemberProfile.nonce;
      profile.ajaxurl = dxlMemberProfile.ajaxurl;
      profile.modals = {
        createEventModal: $("#createEventModal"),
        editEventModal: $("#edit-event-modal"),
        deleteEventModal: $("#delete-event-modal"),
        publishEventModal: $("#publish-event-modal"),
        unpublishEventModal: $("#unpublish-event-modal"),
      };

      profile.buttons = {
        createEventButton: $(".create-event-btn"),
        updateEventButton: $(".update-event-btn"),
        deleteEventButton: $(".delete-event-button"),
        publishUnpublishButton: $(".publish-unpublish-event-btn"),
        unpublishEventButton: $(".unpublish-event-button"),
      };

      profile.forms = {
        createEventForm: $(".create-event-modal-form"),
        updateCooperationEventForm: $(".update-cooperation-event-form"),
      };

      profile.actions = {
        requestTrainerPermissions: "dxl_request_trainer_permissions",
        createEvent: "dxl_profile_create_event",
        editEvent: "dxl_profile_edit_event",
        deleteEvent: "dxl_profile_delete_event",
        publisUnpublishEvent: "dxl_profile_publish_unpublish_event",
        updateProfileInformation: "dxl_profile_update_profile_information",
        createGame: "dxl_profile_create_game",
        editGame: "dxl_profile_edit_game",
        deleteGame: "dxl_profile_delete_game",
      };

      profile.bindEvents();
    },

    /**
     * Bind all profile events
     */
    bindEvents: () => {
      profile.bindCreateEvent();
      profile.bindUpdateCooperationEvent();
      profile.bindPublishUnpublishEvent();
      profile.bindRequestTrainerPermissions();
    },
    
    /**
     * Bind create event action
     */
    bindCreateEvent: () => {

      /**
       * @TODO: check for event type, and append correct form fields to modal
       */
      console.log($("select[name='event-type']").val());

      const eventType = $("select[name='event-type']");

      eventType.change((e) => {

        if ( e.target.value === "training" ) {
          $('.training-fields').removeClass('d-none');
          $('.tournament-fields').addClass('d-none');
          $('.cooperation-fields').addClass('d-none');
        } else if (e.target.value == "tournament") {
          $('.tournament-fields').removeClass('d-none')
          $('.training-fields').addClass('d-none');
        } else {
          $('.training-fields').addClass('d-none');
          $('.tournament-fields').addClass('d-none');
          $('.cooperation-fields').removeClass('d-none');
        }
      })

      /**
       * When the create event button is clicked, submit the fields to the server to create the event
       */
      profile.buttons.createEventButton.click((e) => {
        e.preventDefault();
        const values = getFormValues(profile.forms.createEventForm);
        // values.action = "dxl_profile_create_event";
        values.action = profile.actions.createEvent;
        values.nonce = profile.nonce;
        values.profile = dxlMemberProfile.member.user_id;
        console.log(values);
        ajaxRequest(
          profile.ajaxurl,
          "POST",
          values,
          (response) => {
            console.log(response);

            const parsed = JSON.parse(response);

            if (parsed.status == "success") {
              window.location.reload();
            }

            if (parsed.status == "error") {
              console.log(parsed);
            }
            
            profile.buttons.createEventButton.html("Gå videre");
          },
          () => {
            profile.buttons.createEventButton.html("Opretter...");
          },
          (error) => {
            console.log(error);
            profile.buttons.createEventButton.html("Gå videre");
          }
        );
      });
    },

    /**
     * Bind update cooperation event action
     * 
     * @return void
     */
    bindUpdateCooperationEvent: () => {
      const type = "cooperation";
      profile.buttons.updateEventButton.click((e) => {
        e.preventDefault();
        const values = getFormValues(profile.forms.updateCooperationEventForm);
        values.action = profile.actions.editEvent;
        values.nonce = profile.nonce;
        values.type = type;
        console.log(values);
        ajaxRequest(
          profile.ajaxurl,
          "POST",
          values,
          (response) => {
            console.log(response);
            const parsed = JSON.parse(response);

            if (parsed.status == "success") {
              window.location.reload();
            }

            if (parsed.status == "error") {
              console.log(parsed);
            }
          },
          () => {
            profile.buttons.updateEventButton.html("Opdaterer...");
          },
          (error) => {
            console.log(error);
            profile.buttons.updateEventButton.html("Opdater");
          }
        )
      })
    },

    /**
     * Bind publishing event action
     */
    bindPublishUnpublishEvent: () => {
      profile.buttons.publishUnpublishButton.click((e) => {
        console.log(e)
        const eventId = e.currentTarget.dataset.event;
        const type = e.currentTarget.dataset.eventType;
        const eventAction = e.currentTarget.dataset.action;

        console.log(e);
        console.log(eventAction);

        ajaxRequest(profile.ajaxurl, "POST", {
          action: profile.actions.publisUnpublishEvent,
          nonce: profile.nonce,
          event_id: eventId,
          event_type: type,
          event_action: eventAction
        }, (response) => {
          console.log(response);
          const parsed = JSON.parse(response);
        
          if (parsed.status == "success") {
            window.location.reload();
          }
  
          if ( parsed.status == "failed" ) {
            console.log(parsed);
          }

          if( eventAction == "publish" ) {
            profile.buttons.publishUnpublishButton.html("Offentliggør");
          } else {
            profile.buttons.publishUnpublishButton.html("Skjul");
          }

        }, () => {
          if( eventAction == "publish" ) {
            profile.buttons.publishUnpublishButton.html("Offentliggører event...");
          } else {
            profile.buttons.publishUnpublishButton.html("Skjuler...");
          }
        }, (error) => {
            console.log(error);
        })
      });      
    },

    /**
     * Bind request trainer permissions action
     */
    bindRequestTrainerPermissions: () => {
      $("#request-trainer-permissions").on("click", function (e) {
        e.preventDefault();
        ajaxRequest(
          profile.ajaxUrl,
          "POST",
          {
            action: profile.actions.requestTrainerPermissions,
            nonce: profile.nonce,
          },
          (response) => {
            console.log(response);
          },
          (error) => {
            console.log(error);
          },
          () => {
            console.log("before send");
          }
        );
      });
    },
  };

  profile.init();
})(jQuery);