@extends('frontend.layout.master')

@section('main_content')
    <div class="page-top">
        <div class="bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>FAQ</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Accordion Item #1
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>
                                        Lorem ipsum dolor sit amet, ut has quidam prodesset, eos sumo ipsum civibus ea, vel
                                        quas nusquam ei. Et sea doming quodsi audire. No vim ornatus scaevola disputando,
                                        qui stet ceteros ad. Ad his choro appetere mnesarchum, no duo accusata incorrupte,
                                        vel essent fabulas ut.
                                    </p>
                                    <p>
                                        Ne nam soluta libris. Cu sea utamur adipiscing, convenire patrioque dignissim et
                                        nec. Accusam incorrupte vituperatoribus vix ad, ei clita omnium mentitum pro. Est ad
                                        duis perpetua recteque, in autem posidonium qui. Illum nulla dolor mea an.
                                    </p>
                                    <p>
                                        Officiis disputationi ne pri, libris malorum eam id. Molestie principes vix no. Ut
                                        velit iudicabit inciderint mea. Malorum mediocrem deseruisse nam ne, tale imperdiet
                                        vim ut. Aperiri splendide cu eos, vis in alia laoreet aliquando.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
