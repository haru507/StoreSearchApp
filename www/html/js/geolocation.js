if( navigator.geolocation ){// 現在位置を取得できる場合の処理
  // 現在位置を取得する
  navigator.geolocation.getCurrentPosition( success, error, option);
  /*現在位置が取得できた時に実行*/
  function success(position){
    
    var data = position.coords;
    // 必要な緯度経度だけ取得
    const lat = data.latitude;
    // const lat = 35.690921;
    const lng = data.longitude;
    // const lng = 139.70025799999996;
    localStorage.setItem('lat', lat);
    localStorage.setItem('lng', lng);

    //Google Mapsで住所を取得
    var geocoder = new google.maps.Geocoder();
    latlng = new google.maps.LatLng(lat, lng);
    geocoder.geocode({'latLng': latlng}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        const a = results[0].formatted_address;
        const b = a.split(" ");
        const d = b[1].substr(0, 3)
        if(d.indexOf("東京都") != -1){
          const e = b[1].substr(3, 5)
          document.getElementById('address').innerHTML = e;
          return;
        }else if(d.indexOf('北海道') != -1){
          document.getElementById('address').innerHTML = d;
          return;
        }
        console.log(d)
        const c = b[1].split("県");
        document.getElementById('address').innerHTML = c[0];
      }else {
        alert("エラー" + status);
      }
    });
  }
  /*現在位置の取得に失敗した時に実行*/
  function error(error){
  var errorMessage = {
    0: "原因不明のエラーが発生しました。",
    1: "位置情報が許可されませんでした。",
    2: "位置情報が取得できませんでした。", 
    3: "タイムアウトしました。", 
  };
  //とりあえずalert
  alert( errorMessage[error.code]);
  }
  // オプション(省略可)
  var option = {
    "enableHighAccuracy": false,
    "timeout": 100 ,
    "maximumAge": 100 ,
  } ;
  } else {// 現在位置を取得できない場合の処理
  //とりあえずalert
    alert("あなたの端末では、現在位置を取得できません。");
  }