@props(['placeholder' => 'Search...', 'btn' => 'btn-outline-base'])
<div class="input-group coustom-input-group w-auto flex-fill">
    <input type="search" name="search" class="form--control br-right--0 w-100 bg-white" placeholder="{{ __($placeholder) }}" value="{{ request()->search }}">
    <button class="btn btn-outline-base br-right input-group-text" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
</div>
