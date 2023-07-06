const serverApi = '/api';

export class Http {
  #baseUrl;

  constructor(baseUrl) {
    this.#baseUrl = baseUrl;
  }

  async #makeRequest(url = '/', method = 'GET', data) {
    const headers = {
      "Content-Type": "application/json"
    }
  
    const config = {
      method: method.toLocaleUpperCase(),
      headers,
    };
  
    if (data) {
      config.body = JSON.stringify(data);
    }
    
    const res = await fetch(`${this.#baseUrl}${url}`, config);
    
    const textRes = await res.text();

    if (textRes) {
      return JSON.parse(textRes);
    }
  }

  get(url) {
    return this.#makeRequest(url);
  }
  
  post(url, data) {
    return this.#makeRequest(url, 'post', data);
  }
  
  delete(url) {
    return this.#makeRequest(url, 'delete');
  }
}

export const http = new Http(serverApi);