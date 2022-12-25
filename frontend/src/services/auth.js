export default (httpClient) => ({
  login: async ({ email, password }) => {
    const response = await httpClient.post("/login", {
      email,
      password,
    });

    let errors = null;

    if (!response.data) {
      errors = {
        status: response.request.status,
        statusText: response.request.statusText,
      };
    }

    return {
      data: response.data,
      errors,
    };
  },
  register: async ({ name, email, password }) => {
    const response = await httpClient.post("/register", {
      name,
      email,
      password,
    });

    let errors = null;

    if (!response.data) {
      errors = {
        status: response.status,
        statusText: response.statusText,
      };
    }

    return {
      data: response.data,
      errors,
    };
  },
});
