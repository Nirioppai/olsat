<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentResultNonverbalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        create view `student_result_nonverbal` as
                (
                  Select
                      olsat.final_student_datas.id,
                      olsat.final_student_datas.student_id,
                      olsat.final_student_datas.student_name,
                      olsat.final_student_datas.quantitative_reasoning,
                      olsat.final_student_datas.figural_reasoning,
                      olsat.final_student_datas.non_verbal_total_score As nonverbal_total_score,
                      olsat.raw_to_scaled_nonverbal.scaledscore As nonverbal_scaled_score,
                      olsat.scaled_to_sai_nonverbal.sai As nonverbal_sai,
                      olsat.sai_to_percentile_rank_and_stanines.percentile_rank As nonverbal_percentile_rank,
                      olsat.sai_to_percentile_rank_and_stanines.stanine As nonverbal_stanine,
                      olsat.sai_to_percentile_rank_and_stanines.classification As nonverbal_classification,
                      olsat.final_student_datas.batch,
                      olsat.final_student_datas.exam_date
                  From
                      olsat.final_student_datas Inner Join
                      olsat.scaled_to_sai_nonverbal On
                              olsat.scaled_to_sai_nonverbal.age = olsat.final_student_datas.rounded_current_age_in_years
                              And olsat.scaled_to_sai_nonverbal.month = olsat.final_student_datas.rounded_current_age_in_months Inner Join
                      olsat.raw_to_scaled_nonverbal On
                              olsat.raw_to_scaled_nonverbal.rawscore = olsat.final_student_datas.non_verbal_total_score
                              And olsat.scaled_to_sai_nonverbal.gradescore = olsat.raw_to_scaled_nonverbal.scaledscore Inner Join
                      olsat.sai_to_percentile_rank_and_stanines On olsat.sai_to_percentile_rank_and_stanines.sai =
                              olsat.scaled_to_sai_nonverbal.sai
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
      DB::statement("drop view student_result_nonverbal");
    }
}
