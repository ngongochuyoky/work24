<div class="row justify-content-center">
	<div class="col-md-12 col-sm-12 col-10">
		<form action="{{route('getSearch')}}" method="post">
			<div class="input_search">
				<i class="fa fa-search"></i>
				<input type="text" placeholder="Nhập chức danh, vị trí, kỹ năng..." name="name_title"
				value="<?php if(isset($name_title) && $name_title !== null) {echo $name_title;} ?>" 
				>
			</div>
			<div class="allWork">
				<i class="fa fa-bars"></i>
				<select class="js-example-basic-single" name="nganh_nghe">
					<option 
						value="<?php if(isset($str_nganh_nghe) && $str_nganh_nghe !== null) {echo $str_nganh_nghe;} ?>">

					<?php if(isset($str_nganh_nghe) && $str_nganh_nghe !== null) {echo $str_nganh_nghe;} else {echo "Tất cả ngành nghề";} ?>
						
					</option>
					@if(isset($category))
						@foreach($category as $value) 
							<option value="{{$value['name_category']}}">
								{{$value['name_category']}}
							</option>
						@endforeach
					@endif
				</select>
			</div>
			<div class="place">
				<i class="fa fa-map-marker"></i>
				<select class="js-example-basic-single" name="city">

						<option 
							value=" <?php if(isset($str_city) && $str_city !== null) {echo $str_city;} ?> ">
								<?php if(isset($str_city) && $str_city !== null) {echo $str_city;} else {echo "Tất cả địa điểm";} ?>
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