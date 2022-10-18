import { getFormValues, useAjaxRequest } from "./utilities";
import { useDialog, usePrompt, useConfirm, useAlert } from "./utilities/dialog";
(($) => {
  const profile = {
    init: () => {
      // profile.profileUtility = profileUtility;
      profile.url = dxlMemberProfile.prefix + "/manager-profile";
      profile.nonce = dxlMemberProfile.nonce;
      profile.ajaxurl = dxlMemberProfile.ajaxurl;
      profile.modals = {
        createEventModal: $("#createEventModal"),
        editEventModal: $("#edit-event-modal"),
        editTrainingEventModal: $("#trainingEventUpdateModal"),
        deleteEventModal: $("#delete-event-modal"),
        publishEventModal: $("#publish-event-modal"),
        unpublishEventModal: $("#unpublish-event-modal"),
      };

      profile.buttons = {
        createEventButton: $(".create-event-btn"),
        updateEventButton: $(".update-event-btn"),
        updateTrainingEventButton: $(".update-training-event-btn"),
        deleteEventButton: $(".delete-event-button"),
        publishUnpublishButton: $(".publish-unpublish-event-btn"),
        unpublishEventButton: $(".unpublish-event-button"),
        updateMemberButton: $(".update-member-btn"),
        createGameButton: $(".submit-add-profile-game"),
        deleteGameButton: $('.delete-profile-game')
      };

      profile.forms = {
        createEventForm: $(".create-event-modal-form"),
        updateCooperationEventForm: $(".update-cooperation-event-form"),
        updateTrainingEventForm: $(".update-training-event-form"),
        updateProfileForm: $('.update_profile_settings_form'),
        createGameForm: $('.dxl-profile-add-game-form'),
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

      $('.nav-toggler').click((e) => {
        console.log("clicked");
        $('.nav-list').addClass('active');
      });

      $('.close-button').click((e) => {
        $('.nav-list').removeClass('active');
      })


      profile.bindUpdateMember();
      profile.bindCreateEvent();
      profile.bindDeleteEvent();
      profile.bindUpdateCooperationEvent();
      profile.bindUpdateTrainingEvent();
      profile.bindPublishUnpublishEvent();
      profile.bindGameEvents();
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
        useAjaxRequest(
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
     * Bind delete event action
     * 
     * 26/09-22
     */
    bindDeleteEvent() {
      profile.buttons.deleteEventButton.click((e) => {

        useConfirm("Er du sikker på at du vil slette dette event?", (result) => {
          console.log(result);

          if ( result ) {
            const eventId = e.currentTarget.dataset.event;
            const type = e.currentTarget.dataset.type;

            profile.deleteEventAjax(eventId, type);
          }
        });
      })
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
        useAjaxRequest(
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
     * Bind update training event action
     * 
     * 27/09/2022
     */
    bindUpdateTrainingEvent() {
      const type = "training";
      profile.buttons.updateTrainingEventButton.click((e) => {
        e.preventDefault();
        const values = getFormValues(profile.forms.updateTrainingEventForm);
        values.action = profile.actions.editEvent;
        values.nonce = profile.nonce;
        values.type = type;

        useAjaxRequest(profile.ajaxurl, 'POST', values, (response) => {
          console.log(response);

          const parsed = JSON.parse(response);

          if (parsed.status == "success") {
            window.location.reload();
          }

          if (parsed.status == "error") {
            console.log(parsed);
          }
          profile.buttons.updateTrainingEventButton.html("Opdater");
          profile.modals.editTrainingEventModal.modal('hide');
        }, () => {
          console.log("Updating event...");
          profile.buttons.updateTrainingEventButton.html("Opdaterer...");
        }, (error) => {
          console.log(error);
          profile.buttons.updateTrainingEventButton.html("Opdater");
        })
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

        useAjaxRequest(profile.ajaxurl, "POST", {
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
     * Bind request update member information
     */
    bindUpdateMember: () => {
      profile.buttons.updateMemberButton.click((e) => {
        e.preventDefault();

        const values = getFormValues(profile.forms.updateProfileForm);
        values.action = profile.actions.updateProfileInformation;
        values.nonce = profile.nonce;

        useAjaxRequest(profile.ajaxurl, "POST", values, (response) => {
          console.log(response);
          const parsed = JSON.parse(response);

          if (parsed.status == "error") {
            useAlert("Der skete en fejl, prøv igen senere", () => {
              console.log(parsed);
            });
          } else {
            useAlert("Dine oplysninger blev opdateret", () => {});
          }

          profile.buttons.updateMemberButton.attr('value', "Gem");
        }, () => {

          useAlert("Opdaterer Dine oplysninger", () => {
            console.log("Updating member...");
          })

          console.log("Updating member...");
          profile.buttons.updateMemberButton.attr('value', "Opdaterer...");
        }, (error) => {
          console.log(error);
        })
      })

    },
    
    /**
     * Bind all game related events
     */
    bindGameEvents: () => {
      profile.buttons.createGameButton.click((e) => {
        e.preventDefault()

          const values = getFormValues(profile.forms.createGameForm);
          values.action = profile.actions.createGame;
          values.nonce = profile.nonce;

          useAjaxRequest(profile.ajaxurl, "POST", values, (response) => {
            console.log(response);

            if ( response.success ) {
              window.location.reload();
            }

            if ( response.success == false ) {
              console.log(response.data.message);
            }

          }, () => {
            console.log("Creating game...");
          }, (error) => {
            console.log(error);
          })
      });

      // deleting game event
      profile.buttons.deleteGameButton.click((e) => {
          e.preventDefault()
          const gameId = e.currentTarget.dataset.game;

          useConfirm("Er du sikker på at du vil slette dette spil?", (result) => {
            if ( result ) {
              const action = profile.actions.deleteGame;
    
              profile.deleteGameAjax(gameId, {
                gameId: gameId,
                action: action,
                nonce: profile.nonce
              });
            }
          });
      })
    },

    /**
     * request to delete game
     * @param {*} game 
     * @param {*} action 
     */
    deleteGameAjax: (game, data) => {
      useAjaxRequest(profile.ajaxurl, "POST", data, (response) => {
          console.log(response);
          if ( response.success ) {
            useAlert("Spillet er blevet slettet", () => {
              window.location.reload();
            });
          } else {
            console.log(response.data.message);
          }
        }, () => {
          useDialog({
            title: "Sletter spil",
            message: "Sletter spil vent venligst..."
          })
        }, (error) => {
          console.log(error);
        }
      )
    },

    /**
     * send request to server to delete event 
     * @param {*} event 
     * @param {*} type 
     */
    deleteEventAjax: (event, type) => {
      useAjaxRequest(profile.ajaxurl, "POST", {
          action: profile.actions.deleteEvent,
          nonce: profile.nonce,
          event_id: event,
          event_type: type,
        }, (response) => {
          console.log(response);

          const parsed = JSON.parse(response);

          if (parsed.status == "success") {
            // go back two step
            window.location.href = profile.url + "?module=events";
          }   
        }, () => {
          useDialog({
            title: "Sletter begivenhed...",
            message: "Vent venligst mens begivenheden bliver slettet..."
          })
        }, (error) => {
          console.log(error);
        });
    }
  };

  profile.init();
})(jQuery);