<?php

namespace App\Http\Controllers;

use App\Models\ConsoCarburantMission;
use App\Models\ConsoMission;
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

    /**
     * Get the last mission of a vehicle that is not completed
     */

    function getLastMissionVehicule(Request $request)
    {

        $vehicule_id = $request->vehicule_id;

        try {

            $last_mission = ConsoMission::where("completed", 0)
                ->where("vehicule_id", $vehicule_id)
                ->orderBy("date_debut", "desc")
                ->first();


            if ($last_mission) {

                $code_erreur = 0;
                $message = "Dernière mission trouvée avec succès.";
                return response()->json(compact("message", "code_erreur", "last_mission"));
            } else {

                $code_erreur = 1;
                $message = "Aucune mission trouvée pour ce véhicule.";
                return response()->json(compact("message", "code_erreur"));
            }

            //code...
        } catch (\Throwable $th) {

            $code_erreur = 1;
            $message = $th->getMessage();
            return response()->json(compact("message", "code_erreur"));
        }
    }


    /**
     * Marquer une mission comme terminée
     */
    function terminerMission(Request $request)
    {
        $mission_id = $request->mission_id;
        try {

            $mission = ConsoMission::findOrFail($mission_id);

            $mission->etat = "termine";
            $mission->save();

            $code_erreur = 0;
            $message = "Mission marquée comme terminée avec succès.";
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

    // restaurer une mission
    function restaurerMission(Request $request)
    {
        $mission_id = $request->mission_id;
        try {
            $mission = ConsoMission::findOrFail($mission_id);
            $mission->etat = "en_cours";
            $mission->save();

            $code_erreur = 0;
            $message = "Mission restaurée avec succès.";
            $request->session()->flash('success', $message);
            return response()->json(compact("message", "code_erreur"));
        } catch (\Throwable $th) {

            $code_erreur = 1;
            $message = $th->getMessage();
            $request->session()->flash('error', $message);
            return response()->json(compact("message", "code_erreur"));
        }
    }


    //supprimer une mission
    function supprimerMission(Request $request)
    {
        $mission_id = $request->mission_id;
        try {
            $mission = ConsoMission::findOrFail($mission_id);
            $mission->delete();

            $code_erreur = 0;
            $message = "Mission supprimée avec succès.";
            $request->session()->flash('success', $message);
            return response()->json(compact("message", "code_erreur"));
        } catch (\Throwable $th) {

            $code_erreur = 1;
            $message = $th->getMessage();
            $request->session()->flash('error', $message);
            return response()->json(compact("message", "code_erreur"));
        }
    }
}
