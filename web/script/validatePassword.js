$(document).ready(function(){

    $('#registerform-password').change(function(e) {
        e.preventDefault();
        let string = $(this).val();
        let text = '';

        if (string.length >= 4) {
            text = `<p><b style="color:#ee1010;">Слабый</b> (добавьте заглавные и прописные буквы)</p>`;
            if (string.length >= 6 && /^(?=.*[A-Z])(?=.*[a-z]).+$/.test(string)) {
                text = `<p><b style="color:#ee8e10;">Средний</b> (добавьте цифры)</p>`;
                if (/^(?=.*[0-9]).+$/.test(string)) {
                    text = `<p><b style="color:#ffe600;">Хороший</b> (добавьте знаки: !,#,$,%)</p>`;
                    if (/^(?=.*[!#$%]).+$/.test(string)) {
                        text = `<p style="color:#10ee10;"><b>Надежный</b></p>`;
                    }
                }
            }
        }

        if (text) {
            if (($(this).next()).is('p')) {
                ($(this).next()).remove();
            } 
            $(this).after(text);
        }
        
    });

});