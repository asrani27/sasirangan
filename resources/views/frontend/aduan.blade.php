<a href="https://api.whatsapp.com/send?phone={{$aduan == null ? '0000': $aduan->nomor}}" target="_blank">
    <button class="btn-floating whatsapp">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/WhatsApp_icon.png/598px-WhatsApp_icon.png" width="30px" alt="whatsApp">ADUAN
        <span>{{$aduan == null ? '0000': $aduan->nomor}}</span>
    </button>
</a>