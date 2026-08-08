
$(document).ready(function () {

    setAnwers()

    const options = {
        valueNames: ['kode', 'question'],
        pagination: true,
        page: 1
    };
    const dataList = new List('data-list', options);

    $('.prev-btn').click(function () {
        $('.pagination .active').prev().trigger('click')
        checkLast()
    });

    $('.next-btn').click(function () {
        let $activePage = $('.list .item:visible'); // Ambil item yang sedang terlihat (soal aktif)

        // Cek apakah ada jawaban yang dipilih dalam halaman saat ini
        if ($activePage.find('input[type="radio"]:checked').length === 0) {
            alert('Harap pilih jawaban sebelum melanjutkan!');
            return;
        }

        let $paginationActive = $('.pagination .active');

        if ($paginationActive.next().length === 0) {
            saveFinalAnswers();
        } else {
            $paginationActive.next().trigger('click');
            checkLast();
        }
    });

    $(document).on('change', 'input[type="radio"]', function () {
        const questionId = $(this).data('question-id');
        const answer = $(this).val();

        // console.log(`Jawaban dipilih untuk question_id: ${questionId} => ${answer}`);

        let savedAnswers = JSON.parse(localStorage.getItem('answers')) || [];

        const existingAnswerIndex = savedAnswers.findIndex(item => item.question_id === questionId);

        if (existingAnswerIndex !== -1) {
            savedAnswers[existingAnswerIndex].multiple_choice = answer;
            savedAnswers[existingAnswerIndex].save = false;
        } else {
            savedAnswers.push({
                user_id: "{{ Auth::user()->id }}",
                question_id: questionId,
                multiple_choice: answer,
                save: false
            });
        }

        localStorage.setItem('answers', JSON.stringify(savedAnswers));
        setTimeout(() => {
            let $activePage = $('.pagination .active');

            if ($activePage.next().length === 0) {
                saveFinalAnswers();
            } else {
                $activePage.next().trigger('click');
                checkLast()
            }
        }, 600);

        // console.log('Jawaban tersimpan di localStorage:', savedAnswers);
    });

    setInterval(function () {
        let savedAnswers = localStorage.getItem('answers') ? JSON.parse(localStorage.getItem('answers')) : [];

        const unsavedAnswers = savedAnswers.filter(item => !item.save);

        if (unsavedAnswers.length > 0) {
            console.log('Data yang belum tersimpan ke database:', unsavedAnswers);

            $.ajax({
                url: "{{ route('peserta.test.answer') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    answers: unsavedAnswers,
                },
                success: function (response) {
                    // console.log('Data berhasil disimpan:', response.message);

                    savedAnswers = savedAnswers.map(item => {
                        if (unsavedAnswers.some(unsaved => unsaved.question_id === item.question_id)) {
                            item.save = true;
                        }
                        return item;
                    });

                    localStorage.setItem('answers', JSON.stringify(savedAnswers));
                    console.log('Status jawaban setelah disimpan:', savedAnswers);
                },
                error: function (xhr) {
                    console.error('Gagal menyimpan data:', xhr.responseText);
                }
            });
        } else {
            console.log('Tidak ada data baru untuk disimpan.');
        }
    }, 5000);
});

function setAnwers() {

    let savedAnswers = []

    answers.forEach(function (item, i, o) {
        savedAnswers.push({
            user_id: "{{ Auth::user()->id }}",
            question_id: item.question_id,
            multiple_choice: item.multiple_choice,
            save: false
        });
    })

    localStorage.setItem('answers', JSON.stringify(savedAnswers));
}

function saveFinalAnswers() {
    let sheet = "{{ $sheet }}";
    let savedAnswers = JSON.parse(localStorage.getItem('answers')) || [];

    // Cek apakah ada jawaban yang masih kosong
    let hasEmptyAnswer = savedAnswers.some(answer => !answer.multiple_choice || answer.multiple_choice === '');

    if (hasEmptyAnswer) {
        console.log("Ada jawaban yang masih kosong, halaman akan direload.");
        alert('Anda belum menjawab semua pertanyaan, silahkan isi terlebih dahulu!')
        window.location.reload(true);
        return;
    }

    if (savedAnswers.length > 0) {
        console.log('Menyimpan jawaban terakhir ke database:', savedAnswers);

        $.ajax({
            url: "/test/final-answer/"+sheet,
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                answers: savedAnswers,
                status: 'selesai'
            },
            success: function (response) {
                console.log('Jawaban berhasil disimpan:', response.message);

                localStorage.removeItem('answers');


                if(sheet == 1){
                    window.location.href = "/test/2";
                }else if(sheet == 2){
                    window.location.href = "/test/3";
                }else if(sheet == 3){
                    localStorage.setItem('iziToastMessage', "Jawaban Anda telah kami simpan, Terima Kasih!");
                    localStorage.setItem('iziToastSuccess', 'true');
                    window.location.href = "{{ route('peserta.menu') }}";
                }

            },
            error: function (xhr) {
                console.error('Gagal menyimpan jawaban terakhir:', xhr.responseText);
            }
        });
    } else {
        console.log('Tidak ada data yang perlu disimpan.');
        window.location.reload(true);
    }
}

function checkLast() {
    if ($('.pagination .active').next().length == 0) {
        $('.next-btn').text('Selesai');
    } else {
        $('.next-btn').text('Selanjutnya');
    }
}

function clearLocalStorage() {
    localStorage.clear();
    console.log("Semua data di localStorage telah dihapus.");
}
