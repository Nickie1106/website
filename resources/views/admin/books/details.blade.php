@extends('layouts.admin')
@section('title', '書籍編集')

@section('content')



        <!-- 詳細セクション -->
        <div class="container mt-4">
            <h2 class="fw-bold text-center py-4">詳細</h2>
            <hr class="border border-dark w-100 mx-auto">
            <div class="row mt-5">
                <!-- 書籍の画像 -->
                <div class="col-md-5 text-center">
                <img src="{{ asset('assets/images/' . $book->image) }}" alt="{{ $book->title }}" class="img-thumbnail" style="width: 60px; height: auto;">
                    <div class="d-flex justify-content-center gap-2">
                    <img src="{{ asset('assets/images/' . $book->image) }}" alt="{{ $book->title }}" class="img-thumbnail" style="width: 60px; height: auto;">
                    <img src="{{ asset('assets/images/' . $book->image) }}" alt="{{ $book->title }}" class="img-thumbnail" style="width: 60px; height: auto;">
                    <img src="{{ asset('assets/images/' . $book->image) }}" alt="{{ $book->title }}" class="img-thumbnail" style="width: 60px; height: auto;">
                    </div>
                </div>

                <!-- 書籍の詳細情報 -->
                <div class="col-md-7">
            <h2 class="fw-bold mb-3">やばい日本史</h2>
            <p><strong>著者名:</strong> 芥川龍之介</p>
            <p><strong>ジャンル:</strong> 総記</p>
            <p><strong>ISBN番号:</strong> 123-123456789</p>
            <p>
              <strong>貸出状況:</strong>
              <span class="badge bg-primary">貸出中</span>
            </p>

            <p>
              <strong>返却予定日:</strong> 2025-01-24</p>
            
            <hr>
            <h5 class="fw-bold">本の概要</h5>
            <p>
              ・本書は、歴史上の知られざる出来事や興味深いエピソードを、独自の視点で描いた一冊です。
              <br>
              ・読む人を飽きさせない筆致で、古代から現代に至る日本の歴史を生き生きと語ります。
            </p>
            <hr>
            <div class="mt-5">
              <h5 class="fw-bold">貸出・返却履歴</h5>
              <div class="table-responsive">
                <table class="table table-striped text-center">
                  <thead>
                    <tr>
                      <th>会員名</th>
                      <th>会員番号</th>
                      <th>貸出日</th>
                      <th>返却日</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>山田 太郎</td>
                      <td>20250001</td>
                      <td>2025-01-20</td>
                      <td>2025-01-30</td>
                    </tr>
                    <tr>
                      <td>山田 花子</td>
                      <td>20250002</td>
                      <td>2025-01-31</td>
                      <td>2025-02-02</td>
                    </tr>
                    <tr>
                      <td>山田 次郎</td>
                      <td>20250003</td>
                      <td>2025-02-20</td>
                      <td>2025-02-30</td>
                    </tr>
                  </tbody>
                </table>
            </div>
          </div>
        </div><!-- /.col-md-7 -->
            </div> <!-- /.row -->
        </div>
    </div> 
</div> 
@endsection
