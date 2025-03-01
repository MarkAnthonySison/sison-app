<form method="POST" action="/token">
    @csrf

    Serach term: <input type="text" name="term" value="" />
    <button type="submit">Go</button>
</form>
