const topBarDesktop = document.getElementById('topBarDekstop')
window.addEventListener('scroll', () => {
    // Check the scroll position, for example, when it goes beyond 100 pixels
    if (window.scrollY >= 100) {
        // Show the scroll indicator
        topBarDesktop.style.boxShadow = '0px 10px 20px 0px rgba(0,0,0,0.1)';
        topBarDesktop.style.transition = "all 1s"
    } else if (window.scrollY < 100){
         topBarDesktop.style.boxShadow = "none";
         topBarDesktop.style.transition = "all 1s"
    }
});


$(document).ready(function() {     
    
    // search
    let xhr = "";     
    $('.searchKeyword').keyup(function(e) {
        e.preventDefault();
        const keyword = $(this).val();
        const url = "/search";
        // const _token = "{{ csrf_token() }}";
        

        // Abort the previous request if it exists
        if (xhr) {
            xhr.abort();
        }

        if (keyword !== '') {
            // Make a new AJAX request
            xhr = $.ajax({
                url: url,
                method: "GET",
                data: {
                    keyword: keyword,                            
                    // _token: _token
                },
                success: function(data) {
                    // console.log(data)
                    $('.container-search-result').html(data);
                },
                error: function(err) {
                    // console.log(err)
                    $('.container-search-result').html("");
                    $('.container-search-result').html("Menu tidak ditemukan");
                }
            });
        } else {
            $('.container-search-result').html("");
            $('.container-search-result').html("Menu tidak ditemukan");
        }
    });
});
