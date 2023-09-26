function findZipcode() {
    var cityInput = document.getElementById('city');
    var city = cityInput.value.trim();

    if (city === '') {
        alert('Vui lòng chọn thành phố');
        return;
    }

    // Gọi API hoặc tìm trong cơ sở dữ liệu để lấy mã Zipcode tương ứng với thành phố

    getZipcodeFromCity(city)
        .then(function(zipcode) {
            var result = document.getElementById('result');
            result.innerText= zipcode;
        })
        .catch(function(error) {
            console.log(error);
            var result = document.getElementById('result');
            result.innerText= "Không tìm thấy mã Zipcode cho " + city;
        });
}

function getZipcodeFromCity(city) {
    return new Promise(function(resolve, reject) {
        // Đoạn mã này đại diện cho việc gọi API hoặc tìm trong cơ sở dữ liệu để lấy mã Zipcode
        // Bạn cần thay thế đoạn này bằng cách tìm mã Zipcode từ nguồn dữ liệu của bạn
        // Đây chỉ là một đoạn mã giả định để minh họa

        var zipcodeData = {
            "Huntsville": "35801 - 35816",
            "Anchorage": "99501 - 99524",
            "Phoenix": "85001 - 85055",
            "Little Rock": "72201 - 72217",
            "Los Angeles": "90001 - 90089",
            "Hills Hills": "90209 - 90213",
            "Denver": "80201 - 80239",
            "Hartford": "06101 - 06112",
            "Dover": "19901 - 19905",
            "Washington": "20001 - 20020",
            "Pensacola": "32501 - 32509",
            "Miami": "33124 - 33190",
            "Orlando": "32801 - 32837",
            "Atlanta": "30301 - 30381",
            "Honolulu": "96801 - 96830",
            "Montpelier": "83254",
            "Chicago": "60601 - 60641",
            "Springfield": "62701 - 62709",
            "Indianapolis": "46201 - 46209",
            "Davenport": "52801 - 52809",
            "Des Moines": "50602 - 50323",
            "Wichita": "67201 - 67221",
            "Hazard": "41701 - 41702",
            "New Orleans": "70112 - 70119",
            "Freeport": "04032 - 04034",
            "Baltimore": "21201 - 21237",
            "Boston": "02101 - 02137",
            "Coldwater": "49036",
            "Gaylord": "49734 - 49735",
            "Duluth": "55801 - 55808",
            "Biloxi": "39530 - 39535",
            "Louis": "63101 - 63141",
            "Laurel": "59044",
            "Hastings": "68901 - 68902",
            "Reno": "89501 - 89513",
            "Ashland": "03217",
            "Livingston": "07039",
            "Santa Fe": "87500 - 87506",
            "Newyork": "10001 - 10048",
            "Oxford": "27565",
            "Walhalla": "58282",
            "Cleveland": "44101 - 44179",
            "Hoa tulip": "74101 - 74110",
            "Portland": "97201 - 97225",
            "Pittsburgh": "15201 - 15244",
            "Newport": "02840 - 02841",
            "Camden": "29020",
            "Aberdeen": "57401 - 57402",
            "Columbia": "37201 - 37222",
            "Austin": "78701 - 78705",
            "Logan": "84321 - 84323",
            "Killington": "05751",
            "Altavista": "24517",
            "Bellevue": "98004 - 98009",
            "Beaver": "25813",
            "Milwaukee": "53201 - 53528",
            "Pinedale": "82941",
            // Các thành phố và mã Zipcode tương ứng khác
        };

        setTimeout(function() {
            if (city in zipcodeData) {
                resolve(zipcodeData[city]);
            } else {
                reject("Không tìm thấy mã Zipcode cho thành phố " + city);
            }
        }, 1000);
    });
}
