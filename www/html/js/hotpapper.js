async function hotpapperAPI () {
  // 半径の取得
  const range = document.selected.range.value;
  // ジャンルの取得
  const genre = document.selected.genre.value;
  // 相場の取得
  const budget = document.selected.marketPrice.value;
  // クーボン仕様の有無
  const coupon = document.selected.coupon.value;
  console.log(coupon)
  console.log(genre)
  // 位置情報
  const lat = localStorage.getItem('lat');
  const lng = localStorage.getItem('lng');　
  // const lat = 34.665767;
  // const lng = 133.918930;
  // console.log(lat + "," + lng)

  const apiKey = "";
  // ホットペッパーAPI
  var url =`http://webservice.recruit.co.jp/hotpepper/gourmet/v1/?key=${apiKey}&lat=${lat}&lng=${lng}&range=${range}&ktai_coupon=${coupon}&genre=${genre}&budget=${budget}&count=100&format=jsonp`;
  console.log(url)
  $.ajax({
    url: url,
    type: 'GET',
    dataType: 'jsonp',
    jsonpCallback: 'callback'
  }).done(function(data) {
    if(data.results.shop.length === 0){
      alert('検索条件に一致するお店がありませんでした。')
      return;
    }
    var dummy = data.results.shop; // 成功時 この処理はダミーなので変更してください
    console.log(data.results.shop);
    const random = Math.floor(Math.random() * dummy.length);
    console.log(dummy.length)
    console.log(random);
    console.log(dummy[random]);
    const access = dummy[random].access.split("/");
    console.log(access[0]);
    console.log(dummy[random].name);
    console.log(dummy[random].photo.mobile.l);
    console.log(dummy[random].genre.name);
    console.log(dummy[random].budget.name);
    console.log(dummy[random].close);
    console.log(dummy[random].coupon_urls.sp);

    localStorage.setItem("name", dummy[random].name)
    localStorage.setItem("image", dummy[random].photo.mobile.l)
    localStorage.setItem("genre", dummy[random].genre.name)
    localStorage.setItem("budget", dummy[random].budget.name)
    localStorage.setItem("close", dummy[random].close)
    localStorage.setItem("lat2", dummy[random].lat)
    localStorage.setItem("lng2", dummy[random].lng)
    if(dummy[random].ktai_coupon === 0){
      localStorage.setItem("coupon", "")
    }else {
      localStorage.setItem("coupon", dummy[random].coupon_urls.sp)
    }

    window.location.href = '../components/relay.php';
    // window.location.href = '../components/result.php';

  }).fail(function(data) {
    alert("エラーが発生しました。")
  });
}
