export default (httpClient) => ({
  getMe: async () => {
    const response = await httpClient.get("/me");

    return {
      data: response.data,
    };
  },
  logout: async () => {
    const response = await httpClient.get("/logout");

    return {
      data: response.data,
    };
  },
});
