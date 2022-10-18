/**
 * Dialog hook methods
 * leo knudsen 2022
 */
import "bootstrap"
import bootbox from 'bootbox'

export const useDialog = (options) => {
    return bootbox.dialog(options);
}

export const useAlert = (alert, callback) => {
    return bootbox.alert(alert, callback);
}

export const useConfirm = (confirm, callback, hasButtons) => {
    return bootbox.confirm({
        message: confirm,
        callback: callback
    })
}
export const usePrompt = (prompt, callback) => {
    return bootbox.prompt({
        title: prompt,
        callback: callback
    })
}