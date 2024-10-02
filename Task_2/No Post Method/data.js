// Function to save form data to localStorage
function saveData() {
    const nama = document.getElementById('nama').value;
    const nim = document.getElementById('Nim').value;
    const email = document.getElementById('email').value;
    const programStudi = document.getElementById('Program Studi').value;

    const data = {
        nama: nama,
        nim: nim,
        email: email,
        programStudi: programStudi
    };

    localStorage.setItem('mahasiswaData', JSON.stringify(data));
}

// Function to load and display data on the information page
function loadData() {
    const data = JSON.parse(localStorage.getItem('mahasiswaData'));

    if (data) {
        document.getElementById('Nama').textContent = data.nama;
        document.getElementById('Nim').textContent = data.nim;
        document.getElementById('email').textContent = data.email;
        document.getElementById('Program Studi').textContent = data.programStudi;
    }
}