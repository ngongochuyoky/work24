<style>
	.formSearch .form_search form div {
    width: calc((100%/2) - 65px);
}
</style>
<div class="row justify-content-center">
	<div class="col-md-12 col-sm-12 col-10">
		<form action="{{route('search_users')}}" method="post">
			<div class="input_search">
				<i class="fa fa-search"></i>
				<input type="text" placeholder="Nhập vị trí..." name="name_position"
				value="<?php if(isset($name_position)) {echo $name_position;} ?>" 
				>
			</div>
			
			<div class="place">
				<i class="fa fa-map-marker"></i>
				<select class="js-example-basic-single" name="city">

						<option 
							value=" <?php if(isset($str_city)) {echo $str_city;} ?> ">
								<?php if(isset($str_city)) {echo $str_city;} else {echo "Tất cả địa điểm";} ?>
						</option>

					@if(isset($cities))
						@foreach($cities as $value) 
							<option value="{{$value['name_cities']}}">
								{{$value['name_cities']}}
							</option>
						@endforeach
					@endif

				</select>
			</div>
			<button type="submit" class="nutBtn">
				Tìm kiếm
			</button>
		</form>
	</div>
</div>