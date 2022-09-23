export const ajaxRequest = (url, method, data, success, beforeSend) => {
  return new Promise((resolve, reject) => {
    $.ajax({
      url,
      method,
      data,
      success: success,
      error: (error) => {
        reject(error);
      },
      beforeSend: beforeSend
    });
  });
}