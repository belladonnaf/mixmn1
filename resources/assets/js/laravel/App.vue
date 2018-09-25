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
    }

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
	            obj.lrc = '[MIXMn1]\n[00:00.00]Playtime ' + response.data[k].length_min + ':' + response.data[k].length_sec + ' Frequency ' + response.data[k].frequency;

	//            if(k==0){
	//	            this.audio = data[k];
	//	          }
	 						
	            this.audio.push(obj);
	 						 
	          }
	      }
	    });		

		}

  }

};
</script>
