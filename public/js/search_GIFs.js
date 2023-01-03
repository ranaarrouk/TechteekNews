

class GifyProvider{

     fullUrl;
     url = 'https://api.giphy.com/v1/gifs/search';
     apiKey = 'vLgh9D5gTIfeVjbQWAMmljvU0k08Xiog';
     query;
     limit = 10;

     constructor(query, limit){
         this.limit = limit;
         this.query = query;
         this.fullUrl = this.url +'?api_key=' + this.apiKey + '&limit=' + this.limit + '&q=' + this.query
     }

    async search() {
       return axios.get(this.fullUrl)
            .then(response => response).catch((err) => {;
        });
    }
}
