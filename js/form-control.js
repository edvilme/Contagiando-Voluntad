const submitFormAsync = async (formElement) => {
    // Get method and action
    const action = formElement.getAttribute('action');
    const method = formElement.getAttribute('method');
    // Get data
    const body = new FormData(formElement);
    // Fetch
    const request = await fetch(action, {
        method, 
        body
    });
    return await request.json();
} 