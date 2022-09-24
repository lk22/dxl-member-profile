/**
 * Returns the values of a form as an object
 * @param element form 
 * @returns 
 */
export const getFormValues = (form) => {
  const values = {};
  const fields = form.serializeArray();

  fields.forEach((field) => {
    values[field.name] = field.value;
  });

  return values;
}

/**
 * Sending custom ajax request
 * @param string url 
 * @param string method 
 * @param object data 
 * @param Function success 
 * @param Function beforeSend 
 * @returns 
 */
export const ajaxRequest = (url, method, data, success, beforeSend, error) => {
  jQuery.ajax({
    url,
    method,
    data,
    success: success,
    error: error,
    beforeSend: beforeSend
  });
}