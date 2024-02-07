<footer class="py-4 mt-auto bg-white">
    <div class="px-4 container-fluid">
        <div class="d-flex justify-content-between small">
            <div class="text-muted">Copyright &copy; <span class="text-sm">Nawansite</span> <span id="tahun"></span>, <span class="fw-bold" id="JamDigital" onload="showTime()"></span></div>
            <div>
                Version 1.1.
            </div>
        </div>
    </div>
</footer>
@push('script')
<script type="text/javascript">
    function showTime() {
        var date = new Date();
        var h = date.getHours(); // 0 - 23
        var m = date.getMinutes(); // 0 - 59
        var s = date.getSeconds(); // 0 - 59
        h = (h < 10) ? "0" + h : h;
        m = (m < 10) ? "0" + m : m;
        s = (s < 10) ? "0" + s : s;
        var time = h + ":" + m + ":" + s;
        document.getElementById("JamDigital").innerText = time;
        document.getElementById("JamDigital").textContent = time;
        setTimeout(showTime, 1000);
    }

    showTime();
</script>
<script type="text/javascript">
    const d = new Date();
    let year = d.getFullYear();
    document.getElementById("tahun").innerHTML = year;
</script>
@endpush