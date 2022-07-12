<div class="passenger_title bg-light rounded p-2">
    <li class="material-icons"> &#xe903;</li>
    <span class="">
        <h3 class="m-0 p-0">Select seats</h3>
        <h6 class="m-0 p-0">Please select seat for all passengers</h6>
    </span>
</div>

<div class="bg-light rounded">


    <!-- <?php
            $ob_checkFile = './sm/sm_flights/123-2022-07-28Y180.json';
            // is_file($checkFile) ? $seatmap_file = file_get_contents($checkFile) : $seatmap_file = file_get_contents('sm/sm_flights/'.preg_match(, $str) . '*.json');
            $seatmap_file = file_get_contents($ob_checkFile);
            $seatmap = json_decode($seatmap_file, true);
            ?>


    <div class="col-md-4 seatmap-container">

        <div data-v-003b1ae4="" class="plane-nose_trung">
            <div data-v-003b1ae4="" class="image_trung image"><svg viewBox="0 0 370 268" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <title>Aircraft</title>
                    <desc>Created with Sketch.</desc>
                    <defs>
                        <path d="M35.5,263.17894 C35.5,160.080262 158.846365,0.452059732 220.5,0.407669811 C282.153635,0.363279889 405.5,160.080262 405.5,263.17894 C405.5,275.511963 405.5,520.186955 405.5,997.203916 L445.5,1017.20392 L445.5,1409.20392 L405.5,1389.20392 L405.5,1845.85222 L35.5,1845.85222 L35.5,1389.20392 L0.5,1409.20392 L0.5,1017.20392 L35.5,997.203916 C35.5,520.239733 35.5,275.564741 35.5,263.17894 Z" id="path-1"></path>
                    </defs>
                    <g id="Extras" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Extras-seating" transform="translate(-804.000000, -123.000000)">
                            <g id="Seating" transform="translate(350.000000, 122.000000)">
                                <g id="Seatmap" transform="translate(405.000000, 0.000000)">
                                    <g id="Seatmap-empty" transform="translate(48.500000, 0.792336)">
                                        <g id="Aircraft" transform="translate(-35.000000, 0.000000)">
                                            <mask id="mask-2" fill="white">
                                                <use xlink:href="#path-1"></use>
                                            </mask>
                                            <g id="Mask">
                                                <use fill="#FFFFFF" fill-rule="evenodd" xlink:href="#path-1"></use>
                                                <path stroke="#CCCCCC" stroke-width="2" d="M1.5,1017.78424 L1.5,1407.48074 L36.5,1387.48074 L36.5,1844.85222 L404.5,1844.85222 L404.5,1387.58588 L444.5,1407.58588 L444.5,1017.82195 L404.5,997.82195 L404.5,997.203916 C404.5,668.483941 404.5,668.483941 404.5,455.934951 C404.5,371.442516 404.5,371.442516 404.5,315.992827 C404.5,293.713497 404.5,293.713497 404.5,278.694854 C404.5,267.306554 404.5,267.306554 404.5,263.17894 C404.5,215.299301 377.224353,151.130909 335.312363,93.7041786 C295.108342,38.6176638 249.667594,1.38666973 220.50072,1.40766955 C191.329031,1.42867284 145.884909,38.6717775 105.687578,93.7375519 C63.7720718,151.157032 36.5,215.301913 36.5,263.17894 C36.5,267.316037 36.5,267.316037 36.5,278.712171 C36.5,293.737824 36.5,293.737824 36.5,316.022514 C36.5,371.48045 36.5,371.48045 36.5,455.974534 C36.5,668.516927 36.5,668.516927 36.5,997.203916 L36.5,997.784238 L1.5,1017.78424 Z"></path>
                                            </g>
                                            <path d="M137.78514,191.215567 L157.716946,211.205027 L127.78514,241.215567 L87.7851404,241.215567 L115.740116,202.571084 L137.78514,191.215567 Z M307.719053,191.227873 L329.764658,202.579084 L357.71486,241.212281 L317.725936,241.212281 L287.785988,211.20253 L307.719053,191.227873 Z M147.75263,186.247182 L217.75263,156.247182 L217.75263,186.247182 L167.75263,206.247182 L147.75263,186.247182 Z M227.847951,156.247182 L297.847951,186.247182 L277.847951,206.247182 L227.847951,186.247182 L227.847951,156.247182 Z" id="Combined-Shape" fill="#F3F3F3" mask="url(#mask-2)"></path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </g>
                </svg></div>
        </div>
        <div>
            <table class="table table-seatmap_trung">
                <tr class="alphabet-row" style="font-weight: bold;">
                    <td>A</td>
                    <td>B</td>
                    <td>C</td>
                    <td>D</td>
                    <td>E</td>
                    <td>F</td>
                </tr>

                @foreach ($seatmap as $key => $value)
                <tr>
                    @foreach ($value as $row => $stt)
                    <td class="<?php if ($stt === 1) {
                                    echo "seat-available_trung";
                                } else if ($stt === 0) {
                                    echo "seat-disabled_trung";
                                } else {
                                    echo "exit-seat_trung";
                                }
                                ?>"><span>{{$key.$row}}</span></td>
                    @endforeach
                </tr>
                @endforeach
            </table>
        </div>
        <div data-v-003b1ae4="" class="plane-tail-wrapper_trung">
            <div data-v-003b1ae4="" class="plane-tail_trung"></div>
        </div>
    </div>
    <div class="col-md-7 offset-md-1">
        <form action="" method="get">
            <table class="table table-tripped table-bordered ">
                <thead class="table-header">
                    <tr>
                        <th>Passenger Name Record</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Seat no</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    pax
                    <tr>
                        pax
                        <td></td>

                        <td id="" class="seatno_trung">
                            <input class="seatInput_trung" type="text" name="">
                            <input style="display: none;" type="text" name="pnr" value="">
                        </td>

                    </tr>

                </tbody>
            </table>
            <button id="confirmBtn" type="submit" class="btn btn-primary">Confirm</button>
        </form>
    </div> -->
</div>