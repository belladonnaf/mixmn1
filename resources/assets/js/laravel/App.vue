<template>
  <div id="app">
    <aplayer :audio="audio" :lrcType="1"></aplayer>
  </div>
</template>

<script>

export default {
  name: 'App',
  data() {
	
    return {
      audio: [],
    };

  },
  mounted(){
		
		if( parseInt(jQuery(".album_id").val()) > 0){

			var api_url = 'http://mix.mn1.net/api/album/' + jQuery(".album_id").val();

	    axios.get(api_url).then(response => {
	      for ( var k in response.data){
	          if(response.data[k]){
	            var obj = {};

	            obj.name = response.data[k].filename;
	            obj.artist = response.data[k].artist;
	            obj.url = response.data[k].mp3_path;
	            obj.cover = response.data[k].img_url;
	 						
	            this.audio.push(obj);
	 						 
	          }
	      }
	    });		

		}

  }

};
</script>
