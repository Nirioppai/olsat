<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentResultTotalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        create view `student_result_total` as
              (
                Select
                    olsat.final_student_datas.id,
                    olsat.final_student_datas.student_id,
                    olsat.final_student_datas.student_name,
                    olsat.final_student_datas.total_score,
                    olsat.raw_to_scaled_total.scaledscore As total_scaled_score,
                    olsat.scaled_to_sai_total.sai As total_sai,
                    olsat.sai_to_percentile_rank_and_stanines.percentile_rank As total_percentile_rank,
                    olsat.sai_to_percentile_rank_and_stanines.stanine As total_stanine,
                    olsat.sai_to_percentile_rank_and_stanines.classification As total_classification,
                    olsat.final_student_datas.batch,
                    olsat.final_student_datas.exam_date
                From
                    olsat.final_student_datas Inner Join
                    olsat.scaled_to_sai_total On olsat.scaled_to_sai_total.age = olsat.final_student_datas.rounded_current_age_in_years
                            And olsat.scaled_to_sai_total.month = olsat.final_student_datas.rounded_current_age_in_months Inner Join
                    olsat.raw_to_scaled_total On olsat.raw_to_scaled_total.rawscore = olsat.final_student_datas.total_score
                            And olsat.scaled_to_sai_total.gradescore = olsat.raw_to_scaled_total.scaledscore Inner Join
                    olsat.sai_to_percentile_rank_and_stanines On olsat.sai_to_percentile_rank_and_stanines.sai =
                            olsat.scaled_to_sai_total.sai
              )
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      DB::statement("drop view student_result_total");
    }
}
