<?php

namespace App\Http\Controllers;

use App\Models\ConsoCarburantMission;
use Illuminate\Http\Request;

class RequeteAjaxController extends Controller
{
    //

    function supprimerRemiseCarburant(Request $request)
    {

        $remise_id = $request->remise_id;

        try {

            $carburant_mission = ConsoCarburantMission::findOrFail($remise_id);

            $carburant_mission->delete();

            //Mettre à 0 les valeurs de distance parcourue, montant depense, quantite carburant pour la remise précédente

            $carburant_mission_precedent = ConsoCarburantMission::where("mission_id", $carburant_mission->mission_id)
                ->where("date_remise", "<", $carburant_mission->date_remise)
                ->where("id", "<>", $carburant_mission->id)
                ->orderBy("date_remise", "desc")
                ->first();

            if ($carburant_mission_precedent) {

                //Mise à jour de l'ancien carburant remis
                $carburant_mission_precedent->distance_parcourue = NULL;
                $carburant_mission_precedent->quantite_carburant_consommee = NULL;
                $carburant_mission_precedent->montant_carburant_depense = NULL;
                $carburant_mission_precedent->save();
            }

            $code_erreur = 1;
            $message = "Remise carburant supprimée avec succès. La remise précédente a été réinitialisée. Vous devez entrer à nouveau les vraies valeurs pour les autres remises afin que la mise à jour appropriée soit effectuée.";
            $request->session()->flash('success', $message);
            return response()->json(compact("message", "code_erreur"));

            //code...
        } catch (\Throwable $th) {

            $code_erreur = 1;
            $message = $th->getMessage();
            $request->session()->flash('error', $message);
            return response()->json(compact("message", "code_erreur"));
        }
    }
}
